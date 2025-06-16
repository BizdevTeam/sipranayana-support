<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Report;
use App\Models\System;
use App\Models\ReportLog;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Report::with(['user', 'system', 'topic']) // Load relasi
            ->get();

        return view('admin.pages.reports', compact('reports'));
    }
    public function user()
    {
        $system = System::all();
        $topic = Topic::where('status', 'Tervalidasi')->get();
        $userId = Auth::id(); // Ambil ID user yang sedang login

        // Ambil semua report yang dibuat oleh user yang sedang login
        $reports = Report::with(['system', 'topic']) // Load relasi yang diperlukan
            ->where('user_id', $userId)
            ->get();

        return view('user.pages.report', compact('system', 'topic', 'reports'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'system_id' => 'required|exists:systems,id',
                'topic_id' => 'nullable|string',
                'custom_topic' => 'nullable|string',
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // Cek apakah topic_id adalah "other"
            if (empty($request->topic_id) || $request->topic_id === 'other') {
                if (!empty($request->custom_topic)) {
                    $topic = Topic::create([
                        'name' => $request->custom_topic,
                        'status' => 'Belum Tervalidasi',
                    ]);
                    $topicId = $topic->id;
                    $topicName = $topic->name;
                } else {
                    return back()->withErrors(['custom_topic' => 'Nama topik harus diisi jika memilih "other"']);
                }
            } else {
                $topic = Topic::find($request->topic_id);
                if (!$topic) {
                    return back()->withErrors(['topic_id' => 'Topik tidak ditemukan']);
                }
                $topicId = $topic->id;
                $topicName = $topic->name;
            }

            // Proses file jika ada
            $fileName = null;
            if ($request->hasFile('file')) {
                // Ambil nama sistem dan buat aman dengan slug
                $system = System::findOrFail($request->system_id)->name;
                $systemSlug = Str::slug($system);

                // Gunakan nama topik atau custom topik, lalu buat slug
                $topicSlug = Str::slug($topicName);

                // Format nama file
                $fileExtension = $request->file('file')->getClientOriginalExtension();
                $fileName = "{$systemSlug}_{$topicSlug}_" . now()->format('Ymd_His') . ".{$fileExtension}";

                // Pastikan folder 'public/images/report_files' ada
                $folderPath = public_path('images/report_files');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                // Pindahkan file ke folder tersebut
                $request->file('file')->move($folderPath, $fileName);
                // Simpan $relativePath ke field file_path atau sejenisnya di database jika diperlukan
            }


            // Simpan laporan ke database
            $report = Report::create([
                'user_id' => $request->user_id,
                'system_id' => $request->system_id,
                'topic_id' => $topicId,
                'topic_name' => $topicName,
                'description' => $request->description,
                'file_proof' => $fileName,
            ]);

            // Simpan log ke report_logs
            $systemName = System::find($request->system_id)->name;
            ReportLog::create([
                'report_id' => $report->id,
                'user_id' => Auth::id(),
                'action' => "melaporkan adanya kesalahan pada {$systemName}",
            ]);

            // Kirim notifikasi ke admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'report_id' => $report->id,
                    'message' => "Laporan baru telah dibuat oleh " . Auth::user()->name . " terkait sistem {$systemName}.",
                    'is_read' => false,
                ]);
            }
            return redirect()->back()->with('success', 'Report berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }



    public function proses(Request $request, $id)
    {
        // Temukan laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Pastikan sistem terkait ada dan ambil nama sistem
        $system = System::findOrFail($report->system_id); // Menggunakan system_id dari laporan
        $systemName = $system->name;

        // Update status laporan
        $report->status = 'Diproses';
        $report->save();

        // Buat entri log untuk tindakan perubahan status
        ReportLog::create([
            'report_id' => $report->id,
            'user_id' => Auth::id(),
            'action' => 'Merubah status laporan tentang ' . $systemName . ' menjadi diproses.',
        ]);

        // Redirect atau kembalikan respons dengan pesan sukses
        return redirect()->back()->with('success', 'Status laporan berhasil diubah menjadi Diproses.');
    }

    public function selesai(Request $request, $id)
    {
        // Temukan laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Pastikan sistem terkait ada dan ambil nama sistem
        $system = System::findOrFail($report->system_id); // Menggunakan system_id dari laporan
        $systemName = $system->name;

        $name = User::findOrFail($report->user_id);
        $userName = $name->name;

        // Update status laporan
        $report->status = 'Selesai';
        $report->save();

        // Buat entri log untuk tindakan perubahan status
        ReportLog::create([
            'report_id' => $report->id,
            'user_id' => Auth::id(),
            'action' => 'Merubah status laporan dari' . $userName . '  tentang ' . $systemName . ' menjadi selesai.',
        ]);

        // Redirect atau kembalikan respons dengan pesan sukses
        return redirect()->back()->with('success', 'Status laporan berhasil diubah menjadi Selesai.');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'system_id' => 'required|exists:systems,id',
                'topic_id' => 'nullable|string',
                'custom_topic' => 'nullable|string',
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $report = Report::findOrFail($id);

            // Cek apakah topic_id adalah "other"
            if (empty($request->topic_id) || $request->topic_id === 'other') {
                if (!empty($request->custom_topic)) {
                    $topic = Topic::create([
                        'name' => $request->custom_topic,
                        'status' => 'Belum Tervalidasi',
                    ]);
                    $topicId = $topic->id;
                    $topicName = $topic->name;
                } else {
                    return back()->withErrors(['custom_topic' => 'Nama topik harus diisi jika memilih "other"']);
                }
            } else {
                $topic = Topic::find($request->topic_id);
                if (!$topic) {
                    return back()->withErrors(['topic_id' => 'Topik tidak ditemukan']);
                }
                $topicId = $topic->id;
                $topicName = $topic->name;
            }

            // Proses file jika ada
            $fileName = $report->file_proof; // default file lama
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                $oldFilePath = public_path('storage/report_files/' . $report->file_proof);
                if ($report->file_proof && file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }

                $system = System::findOrFail($request->system_id)->name;
                $systemSlug = Str::slug($system);
                $topicSlug = Str::slug($topicName);

                $fileExtension = $request->file('file')->getClientOriginalExtension();
                $fileName = "{$systemSlug}_{$topicSlug}_" . now()->format('Ymd_His') . ".{$fileExtension}";

                $folderPath = public_path('storage/report_files');
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $request->file('file')->move($folderPath, $fileName);
            }

            // Update laporan
            $report->update([
                'user_id' => $request->user_id,
                'system_id' => $request->system_id,
                'topic_id' => $topicId,
                'topic_name' => $topicName,
                'description' => $request->description,
                'file_proof' => $fileName,
            ]);

            // Simpan log ke report_logs
            $systemName = System::find($request->system_id)->name;
            ReportLog::create([
                'report_id' => $report->id,
                'user_id' => Auth::id(),
                'action' => "mengubah laporan pada sistem {$systemName}",
            ]);

            return redirect()->back()->with('success', 'Report berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        // Cari laporan berdasarkan ID
        $report = Report::findOrFail($id);

        // Cek apakah file ada di storage/report_files
        if ($report->file_proof && Storage::exists('report_files/' . $report->file_proof)) {
            Storage::delete('report_files/' . $report->file_proof); // Hapus file
        }

        // Hapus laporan dari database
        $report->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('user.report')
            ->with('success_delete', 'Report dan file terkait berhasil dihapus.');
    }
}
