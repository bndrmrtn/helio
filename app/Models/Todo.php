<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model {
    protected $fillable = [
        'description',
        'due_date',
        'completed',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'due_date' => 'date',
    ];
}
