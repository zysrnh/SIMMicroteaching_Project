<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($role)
    {
        if (!in_array($role, ['dosen', 'mahasiswa'])) {
            abort(404);
        }

        $users = \App\Models\User::where('role', $role)->latest()->get();
        return view('admin.users.index', compact('users', 'role'));
    }

    public function import(Request $request, $role)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\UsersImport($role), $request->file('file_excel'));
            return back()->with('success', 'Data ' . ucfirst($role) . ' berhasil diimport!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate($role)
    {
        // Untuk sekarang, kita kembalikan error/redirect jika belum membuat file Export
        // Pada prakteknya kita bisa taruh file dummy di storage, misal:
        $fileName = 'template_import_' . $role . '.xlsx';
        $filePath = public_path('templates/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return back()->with('error', 'File template belum tersedia di server.');
    }
}
