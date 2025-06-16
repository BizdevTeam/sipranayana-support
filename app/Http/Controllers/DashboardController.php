<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Report;
use App\Models\ReportLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $totalReports = Report::count();
    $menunggu = Report::where('status', 'Menunggu Konfirmasi')->count();
    $diproses = Report::where('status', 'Diproses')->count();
    $selesai = Report::where('status', 'Selesai')->count();

    $reportLogs = ReportLog::with(['user', 'report.system', 'report.topic'])
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();

    // Ambil jumlah laporan per sistem
    $reportsBySystem = Report::selectRaw('system_id, COUNT(*) as total')
        ->with('system') // Pastikan ada relasi system di model Report
        ->groupBy('system_id')
        ->get();
    $reportsByTopics = Report::selectRaw('topic_id, COUNT(*) as total')
        ->with('topic')
        ->groupBy('topic_id')
        ->get();
    return view('admin.pages.dashboard', compact(
        'totalReports', 'menunggu', 'diproses', 'selesai', 'reportLogs', 'reportsBySystem','reportsByTopics'
    ));
}

    public function user()
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login
    
        // Ambil semua ID report yang dibuat oleh user ini
        $reportIds = Report::where('user_id', $userId)->pluck('id');

        $totalReports = Report::where('user_id', $userId)->count();
        $menunggu = Report::where('user_id', $userId)->where('status', 'Menunggu Konfirmasi')->count();
        $diproses = Report::where('user_id', $userId)->where('status', 'Diproses')->count();
        $selesai = Report::where('user_id', $userId)->where('status', 'Selesai')->count();
    
        // Ambil semua log yang memiliki report_id sesuai atau dibuat oleh user ini
        $reportLogs = ReportLog::with(['user', 'report.system', 'report.topic'])
            ->whereIn('report_id', $reportIds) // Log berdasarkan report milik user
            ->orWhere('user_id', $userId) // Log yang dibuat sendiri oleh user
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('user.pages.dashboard', compact('reportLogs', 'totalReports','menunggu', 'diproses', 'selesai'));
    }
}
