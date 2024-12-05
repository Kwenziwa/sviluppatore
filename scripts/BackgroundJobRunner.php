<?php
namespace Scripts;

use Illuminate\Support\Facades\Log;
use App\Models\ClassMethod;  // Import the ClassMethod model

class BackgroundJobRunner
{
    /**
     * Run a background jobs.
     *
     * @param string $className
     * @param string $methodName
     * @param array $parameters
     * @param int $maxRetries
     * @param int $delay
     * @param int $priority
     * @return void
     */
    public function runJob(
        string $className,
        string $methodName,
        array $parameters = [],
        int $maxRetries = 3,
        int $delay = 0,
        int $priority = 0
    ): void {
        $retries = 0;
        $lastException = null;

        // Log jobs start by inserting record in database with delay and priority
        $jobLog = $this->logJobStart($className, $methodName, $parameters, $delay, $priority);

        // Apply delay if necessary
        if ($delay > 0) {
            Log::info("Delaying jobs: $className::$methodName by $delay seconds.");
            sleep($delay);  // Delay jobs execution
        }

        // Prioritize jobs based on priority value (higher priority first)
        // You can optionally modify this logic to manage jobs execution order based on priority

        while ($retries < $maxRetries) {
            try {
                // Validate the class and method names
                if (!$this->isValidClass($className) || !$this->isValidMethod($className, $methodName)) {
                    $this->logError($className, $methodName, $parameters, 'Invalid class or method name');
                    $this->updateJobStatus($jobLog->id, 'failed');
                    return;
                }

                // Instantiate the class and call the method
                $instance = new $className();
                // Ensure parameters are in an indexed array
                if (!is_array($parameters)) {
                    $parameters = (array) $parameters;  // Convert to indexed array if necessary
                }
                call_user_func_array([$instance, $methodName], $parameters);

                // Job completed successfully, update status to 'completed'
                $this->updateJobStatus($jobLog->id, 'completed');
                Log::info("Executed jobs: $className::$methodName with parameters: " . json_encode($parameters));
                return;
            } catch (\Exception $e) {
                $retries++;
                $lastException = $e;
                $this->logError($className, $methodName, $parameters, $e->getMessage());

                if ($retries >= $maxRetries) {
                    $this->updateJobStatus($jobLog->id, 'failed');
                    $this->logError($className, $methodName, $parameters, $e->getMessage());
                }
            }
        }
    }

    /**
     * Log jobs start in class_methods table.
     */
    private function logJobStart($className, $methodName, $parameters, $delay, $priority)
    {
        // Insert jobs entry into class_methods table with status 'started'
        return ClassMethod::create([
            'class_name' => $className,
            'method_name' => $methodName,
            'parameters' => json_encode($parameters),
            'status' => 'started',
            'delay' => $delay,  // Store the delay value
            'priority' => $priority,  // Store the priority value
        ]);
    }

    /**
     * Update the jobs status in class_methods table.
     */
    private function updateJobStatus($jobId, $status)
    {
        // Update the jobs status to 'completed' or 'failed'
        $job = ClassMethod::find($jobId);
        if ($job) {
            $job->status = $status;
            $job->save();
        }
    }

    /**
     * Validate class name.
     */
    private function isValidClass($className): bool
    {
        // List of allowed classes
        $allowedClasses = ['App\\Jobs\\JobDemoClass', 'App\\Jobs\\JobDemoClass'];
        return in_array($className, $allowedClasses) && class_exists($className);
    }

    /**
     * Validate method name.
     */
    private function isValidMethod($className, $methodName)
    {
        return method_exists($className, $methodName);
    }

    /**
     * Log jobs error in a separate error log file.
     */
    private function logError($className, $methodName, $parameters, $error)
    {
        $timestamp = now();
        $errorMessage = "[$timestamp] Failed jobs: $className::$methodName with parameters: " . json_encode($parameters) . " Error: $error\n";
        Log::channel('background_jobs_errors')->error($errorMessage);
    }
}
