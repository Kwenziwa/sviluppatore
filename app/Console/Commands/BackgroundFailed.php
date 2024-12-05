<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackgroundFailed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'background-failed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a failed background job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Running the background job, please wait...");
        $spinner = $this->output->createProgressBar();
        $spinner->start();

        // Run the background job
        runBackgroundJob(
            'App\\Jobs\\JobDemoClasss',
            'process',
            ['data', 'data'],
            3,
            15,
            1
        );

        $spinner->finish();
        // Display a message indicating the job has finished
        $this->info("\nRunning a failed background job");
        return 0;
    }
}
