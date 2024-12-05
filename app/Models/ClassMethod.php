<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassMethod extends Model
{
    protected $fillable = ['class_name', 'method_name', 'parameters', 'status', 'delay', 'priority'];
    protected $casts = [
        'parameters' => 'array',
    ];
}
