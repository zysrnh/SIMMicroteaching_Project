<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-slate-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Alert -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-slate-700 transition-colors duration-200">
                <div class="p-6 text-gray-900 dark:text-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-indigo-500/20 flex items-center justify-center text-primary-600 dark:text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-primary-900 dark:text-slate-100">Selamat Datang, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm">
                            Anda login sebagai <strong>{{ $roleName ?? ucfirst(Auth::user()->role) }}</strong>. Ini adalah halaman Dashboard utama Anda.
                        </p>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'mahasiswa')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- ID CARD (KARTU MAHASISWA) -->
                <div class="lg:col-span-1">
                    <div class="relative w-full max-w-sm mx-auto overflow-hidden rounded-2xl shadow-xl hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 group">
                        <!-- Card Background (Gradient) -->
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-primary-700 to-indigo-900 z-0"></div>
                        
                        <!-- Overlay Pattern (Optional, subtle glass effect) -->
                        <div class="absolute inset-0 bg-white/5 z-0 backdrop-blur-sm"></div>
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl z-0 group-hover:bg-white/20 transition-all duration-500"></div>

                        <div class="relative z-10 p-6 flex flex-col h-full text-white">
                            <!-- Card Header -->
                            <div class="flex justify-between items-center border-b border-white/20 pb-3 mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="bg-white p-1 rounded-md">
                                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-6 h-6 object-contain">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-bold tracking-wider uppercase opacity-90">Kartu Tanda Mahasiswa</span>
                                        <span class="text-[9px] opacity-75">SIM Microteaching</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="flex gap-4 items-start">
                                <!-- Avatar -->
                                <div class="w-20 h-20 shrink-0 rounded-lg overflow-hidden border-2 border-white/30 shadow-inner bg-white/10">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-white/50">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1 min-w-0 flex flex-col space-y-2">
                                    <div>
                                        <h4 class="font-bold text-lg leading-tight truncate">{{ Auth::user()->name }}</h4>
                                        <p class="text-xs font-medium text-indigo-200 tracking-wide">{{ Auth::user()->nomor_induk ?? 'NIM Belum Diatur' }}</p>
                                    </div>
                                    
                                    <div class="space-y-1 pt-1">
                                        <div class="flex flex-col">
                                            <span class="text-[9px] text-indigo-300 uppercase tracking-wider">Program Studi</span>
                                            <span class="text-xs font-medium truncate">{{ Auth::user()->prodi ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between items-end gap-2">
                                            <div class="flex flex-col">
                                                <span class="text-[9px] text-indigo-300 uppercase tracking-wider">Kelas</span>
                                                <span class="text-xs font-medium">{{ Auth::user()->kelas ?? '-' }}</span>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[9px] text-indigo-300 uppercase tracking-wider">Semester</span>
                                                <span class="text-xs font-medium">{{ Auth::user()->semester ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="mt-4 pt-3 border-t border-white/20 flex justify-between items-center">
                                <div class="text-[9px] text-indigo-200">
                                    Berlaku selama menjadi Mahasiswa Aktif
                                </div>
                                <div class="w-8 h-8 rounded-sm bg-white/20 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Akademik & Stats -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Quick Stats Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">0</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">Sesi Tampil</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded-full bg-green-50 dark:bg-green-500/10 flex items-center justify-center text-green-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">-</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">Nilai Rata-rata</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded-full bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center text-purple-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">0</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">RPP Diupload</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded-full bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">Belum</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">Jadwal Tampil</span>
                        </div>
                    </div>

                    <!-- Jadwal Tampil Mendatang -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700 p-6 transition-colors">
                        <div class="flex items-center justify-between mb-4 border-b border-gray-50 dark:border-slate-700 pb-3">
                            <h3 class="font-bold text-gray-900 dark:text-slate-100">Jadwal Tampil Terdekat</h3>
                            <a href="#" class="text-sm font-semibold text-primary-600 dark:text-indigo-400 hover:underline">Lihat Semua</a>
                        </div>
                        
                        <div class="flex flex-col items-center justify-center py-8 text-center bg-gray-50 dark:bg-slate-900/50 rounded-lg border border-dashed border-gray-200 dark:border-slate-600">
                            <svg class="w-12 h-12 text-gray-300 dark:text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-sm text-gray-500 dark:text-slate-400">Belum ada jadwal tampil yang ditetapkan untuk Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
