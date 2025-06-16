<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_id',
        'message',
        'is_read',
    ];
}
