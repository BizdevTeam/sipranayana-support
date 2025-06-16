<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'system_id',
        'topic_id',
        'custom_topic',
        'description',
        'file_proof',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pastikan ini ada
    }

    public function system()
    {
        return $this->belongsTo(System::class, 'system_id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function logs()
    {
        return $this->hasMany(ReportLog::class);
    }
}
