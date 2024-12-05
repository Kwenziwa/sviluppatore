<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function runJob()
    {

        runBackgroundJob(
            'App\\Jobs\\JobDemoClass',
            'process',
            ['name', 'email'],
            3,
            15,
            1   
        );
        return response()->json(['message' => 'ClassMethod is running in the background.']);
    }
}
