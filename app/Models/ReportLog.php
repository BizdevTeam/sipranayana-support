<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportLog extends Model
{
    use HasFactory;

    protected $fillable = ['report_id', 'user_id', 'action'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function system()
    {
        return $this->belongsTo(System::class);
    }
}
