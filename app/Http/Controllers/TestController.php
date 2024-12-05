<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function runJob()
    {
        // Example: Running the JobDemoClass with a message
        runBackgroundJob(
            'App\\Jobs\\JobDemoClass',  // Class name
            'processq',  // Method name
            ['name', 'email'],  // Parameters
            3,  // Max retries
            15,  // Delay in seconds
            1   // Priority
        );

        return response()->json(['message' => 'ClassMethod is running in the background.']);
    }
}
