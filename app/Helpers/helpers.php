<?php

use Scripts\BackgroundJobRunner;
use Illuminate\Support\Facades\Log;

if (!function_exists('runBackgroundJob')) {
    /**
     * Run a jobs in the background.
     *
     * @param string $className
     * @param string $methodName
     * @param array $parameters
     * @param int $maxRetries
     * @param int $delay
     * @param int $priority
     * @return void
     */
    function runBackgroundJob(
        string $className,
        string $methodName,
        array $parameters = [],
        int $maxRetries = 3,
        int $delay = 0,
        int $priority = 0
    ): void {
        $runner = new BackgroundJobRunner();
        $runner->runJob($className, $methodName, $parameters, $maxRetries, $delay, $priority);
    }
}
