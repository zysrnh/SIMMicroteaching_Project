@php
    $role = auth()->user()->role ?? 'mahasiswa';
@endphp

<aside class="w-64 bg-white border-r border-gray-100 flex-shrink-0 flex flex-col shadow-sm z-10 relative h-screen sticky top-0">
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 border-b border-gray-50 mb-4">
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-8 h-8 rounded-md object-contain">
            <span class="font-bold text-primary-900 tracking-tight text-lg">SIM Micro</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Menu Utama</p>

        <!-- Dashboard Link (All Roles) -->
        <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl bg-primary-50 text-primary-700">
            <svg class="w-5 h-5 mr-3 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>

        @if($role === 'super_admin' || $role === 'admin')
            <!-- Super Admin & Admin Links -->
            @if($role === 'super_admin')
            <a href="{{ route('admin.users.index', 'admin') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors {{ request()->is('kelola/admin') ? 'bg-primary-50 text-primary-700' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->is('kelola/admin') ? 'text-primary-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Kelola Admin
            </a>
            @endif
            <a href="{{ route('admin.users.index', 'dosen') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors {{ request()->is('kelola/dosen') ? 'bg-primary-50 text-primary-700' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->is('kelola/dosen') ? 'text-primary-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Kelola Dosen
            </a>
            <a href="{{ route('admin.users.index', 'mahasiswa') }}" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors {{ request()->is('kelola/mahasiswa') ? 'bg-primary-50 text-primary-700' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->is('kelola/mahasiswa') ? 'text-primary-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Kelola Mahasiswa
            </a>
            <div class="my-2 border-t border-gray-100"></div>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Kelola Tahun Ajaran
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Kelompok & Plotting
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Kelola Rubrik Penilaian
            </a>

        @elseif($role === 'dosen')
            <!-- Dosen Links -->
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Kelompok Bimbingan
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Beri Penilaian
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Review RPP Mahasiswa
            </a>

        @else
            <!-- Mahasiswa Links -->
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Jadwal Tampil
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Upload RPP
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary-600 transition-colors">
                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                Lihat Nilai Akhir
            </a>
        @endif
    </nav>

    <!-- Support / Footer Area -->
    <div class="p-4 border-t border-gray-50 mt-auto">
        <div class="bg-gold-50/50 rounded-xl p-4 border border-gold-100">
            <h4 class="text-xs font-bold text-gold-600 uppercase tracking-wider mb-1">Bantuan</h4>
            <p class="text-xs text-gray-500 mb-2">Butuh bantuan panduan sistem?</p>
            <a href="#" class="text-xs font-semibold text-primary-600 hover:text-primary-700">Lihat Panduan &rarr;</a>
        </div>
    </div>
</aside>
