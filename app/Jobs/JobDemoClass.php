<?php
namespace App\Jobs;

use Illuminate\Support\Facades\Log;

class JobDemoClass
{
    /**
     * Demo jobs method.
     *
     * @param string $message
     * @return void
     */
    public function process($message)
    {
        Log::info("Processing jobs with message: $message");
        // Simulating some background processing
        sleep(5); // Sleep to simulate jobs processing time
        Log::info("ClassMethod completed with message: $message");
    }
}
