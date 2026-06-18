<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($role)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles)) {
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
        $fileName = 'Template_Import_' . ucfirst($role) . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UsersTemplateExport($role), $fileName);
    }

    public function export($role)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles)) {
            abort(404);
        }

        $fileName = 'Data_' . ucfirst($role) . '_' . date('Ymd_His') . '.xlsx';
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\UsersExport($role), $fileName);
    }

    public function create($role)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles)) {
            abort(404);
        }
        return view('admin.users.create', compact('role'));
    }

    public function store(Request $request, $role)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles)) {
            abort(404);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:users,nomor_induk',
            'email' => 'nullable|email|max:255|unique:users,email',
            'no_telp' => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($role === 'mahasiswa') {
            $rules['kelas'] = 'nullable|string|max:255';
            $rules['semester'] = 'nullable|string|max:255';
            $rules['tahun_ajaran'] = 'nullable|string|max:255';
            $rules['angkatan'] = 'nullable|string|max:255';
            $rules['prodi'] = 'nullable|string|max:255';
        } else {
            $rules['mata_kuliah'] = 'nullable|string|max:255';
            $rules['prodi'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);
        $validated['role'] = $role;
        $validated['password'] = bcrypt($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        \App\Models\User::create($validated);

        return redirect()->route('admin.users.index', $role)->with('success', 'Data ' . ucfirst($role) . ' berhasil ditambahkan!');
    }

    public function edit($role, \App\Models\User $user)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles) || $user->role !== $role) {
            abort(404);
        }
        return view('admin.users.edit', compact('user', 'role'));
    }

    public function update(Request $request, $role, \App\Models\User $user)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles) || $user->role !== $role) {
            abort(404);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'nomor_induk' => 'required|string|max:255|unique:users,nomor_induk,' . $user->id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'no_telp' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($role === 'mahasiswa') {
            $rules['kelas'] = 'nullable|string|max:255';
            $rules['semester'] = 'nullable|string|max:255';
            $rules['tahun_ajaran'] = 'nullable|string|max:255';
            $rules['angkatan'] = 'nullable|string|max:255';
            $rules['prodi'] = 'nullable|string|max:255';
        } else {
            $rules['mata_kuliah'] = 'nullable|string|max:255';
            $rules['prodi'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);
        
        // Update password if provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index', $role)->with('success', 'Data ' . ucfirst($role) . ' berhasil diperbarui!');
    }

    public function destroy($role, \App\Models\User $user)
    {
        $allowedRoles = auth()->user()->role === 'super_admin' ? ['admin', 'dosen', 'mahasiswa'] : ['dosen', 'mahasiswa'];
        if (!in_array($role, $allowedRoles) || $user->role !== $role) {
            abort(404);
        }

        $user->delete();
        return back()->with('success', 'Data ' . ucfirst($role) . ' berhasil dihapus!');
    }
}
