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
                <div class="lg:col-span-1 relative">
                    <!-- Export Button Dropdown -->
                    <div class="absolute top-2 right-2 z-20 flex gap-2" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="p-1.5 bg-white dark:bg-slate-700 rounded-md shadow-sm border border-gray-200 dark:border-slate-600 text-gray-500 hover:text-primary-600 dark:text-slate-300 dark:hover:text-indigo-400 transition-colors" title="Export KTM">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </button>
                        
                        <div x-show="open" style="display: none;" class="absolute right-0 top-8 w-32 bg-white dark:bg-slate-800 rounded-md shadow-lg border border-gray-100 dark:border-slate-700 py-1 z-50">
                            <button onclick="exportKTM('jpg')" class="w-full text-left px-4 py-2 text-xs font-medium text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                JPG Image
                            </button>
                            <button onclick="exportKTM('pdf')" class="w-full text-left px-4 py-2 text-xs font-medium text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 flex items-center">
                                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                PDF Document
                            </button>
                        </div>
                    </div>

                    <div id="ktm-card" class="relative w-full max-w-sm mx-auto overflow-hidden rounded border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:-translate-y-1 hover:shadow-md transition-all duration-300 group aspect-[1.6/1] flex flex-col">
                        
                        <!-- Overlay Pattern (Optional, subtle glass effect) -->
                        <div class="absolute inset-0 bg-gray-50/50 dark:bg-white/5 z-0"></div>

                        <div class="relative z-10 p-5 flex flex-col h-full text-gray-900 dark:text-slate-100 justify-between">
                            <!-- Card Header -->
                            <div class="flex justify-between items-center border-b border-gray-100 dark:border-slate-700 pb-2 mb-3 shrink-0">
                                <div class="flex items-center gap-2">
                                    <div class="p-1 rounded bg-white border border-gray-100 dark:border-slate-600">
                                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-5 h-5 object-contain">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] font-bold tracking-wider uppercase text-primary-700 dark:text-indigo-400">Kartu Tanda Mahasiswa</span>
                                        <span class="text-[8px] text-gray-500 dark:text-slate-400 mt-0.5">SIM Microteaching</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="flex gap-3 items-center flex-1">
                                <!-- Avatar (Pasfoto ratio 3x4) -->
                                <div class="w-16 h-20 shrink-0 rounded overflow-hidden border border-gray-200 dark:border-slate-600 shadow-sm bg-gray-50 dark:bg-slate-700">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-slate-500">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1 min-w-0 flex flex-col justify-center">
                                    <div class="mb-2">
                                        <h4 class="font-bold text-base text-gray-900 dark:text-slate-100 pb-0.5">{{ Auth::user()->name }}</h4>
                                        <p class="text-[10px] font-medium text-gray-500 dark:text-slate-400 tracking-wide">{{ Auth::user()->nomor_induk ?? 'NIM Belum Diatur' }}</p>
                                    </div>
                                    
                                    <div class="space-y-1.5">
                                        <div class="flex flex-col">
                                            <span class="text-[8px] text-gray-400 dark:text-slate-500 uppercase tracking-wider">Program Studi</span>
                                            <span class="text-[11px] font-medium text-gray-700 dark:text-slate-300 pt-0.5">{{ Auth::user()->prodi ?? '-' }}</span>
                                        </div>
                                        <div class="flex justify-between items-end gap-1">
                                            <div class="flex flex-col w-1/2">
                                                <span class="text-[8px] text-gray-400 dark:text-slate-500 uppercase tracking-wider">Kelas</span>
                                                <span class="text-[11px] font-medium text-gray-700 dark:text-slate-300 pt-0.5">{{ Auth::user()->kelas ?? '-' }}</span>
                                            </div>
                                            <div class="flex flex-col w-1/2">
                                                <span class="text-[8px] text-gray-400 dark:text-slate-500 uppercase tracking-wider">Semester</span>
                                                <span class="text-[11px] font-medium text-gray-700 dark:text-slate-300 pt-0.5">{{ Auth::user()->semester ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- QR Code -->
                                <div class="w-14 h-14 rounded bg-white p-1 border border-gray-200 dark:border-slate-600 flex items-center justify-center shrink-0 shadow-sm ml-1">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(Auth::user()->nomor_induk ?? Auth::user()->email) }}" alt="QR Code" class="w-full h-full object-contain">
                                </div>
                            </div>

                            <!-- Card Footer -->
                            <div class="mt-3 pt-2 border-t border-gray-100 dark:border-slate-700 text-center shrink-0">
                                <div class="text-[8px] text-gray-400 dark:text-slate-500 uppercase tracking-widest">
                                    Berlaku Selama Menjadi Mahasiswa Aktif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Akademik & Stats -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Quick Stats Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-white dark:bg-slate-800 p-4 rounded shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-blue-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">0</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">Sesi Tampil</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-4 rounded shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded bg-green-50 dark:bg-green-500/10 flex items-center justify-center text-green-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">-</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">Nilai Rata-rata</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-4 rounded shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center text-purple-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">0</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">RPP Diupload</span>
                        </div>
                        <div class="bg-white dark:bg-slate-800 p-4 rounded shadow-sm border border-gray-100 dark:border-slate-700 flex flex-col items-center justify-center text-center transition-colors">
                            <div class="w-10 h-10 rounded bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-500 mb-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 dark:text-slate-100">Belum</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400 mt-1">Jadwal Tampil</span>
                        </div>
                    </div>

                    <!-- Jadwal Tampil Mendatang -->
                    <div class="bg-white dark:bg-slate-800 rounded shadow-sm border border-gray-100 dark:border-slate-700 p-6 transition-colors">
                        <div class="flex items-center justify-between mb-4 border-b border-gray-50 dark:border-slate-700 pb-3">
                            <h3 class="font-bold text-gray-900 dark:text-slate-100">Jadwal Tampil Terdekat</h3>
                            <a href="#" class="text-sm font-semibold text-primary-600 dark:text-indigo-400 hover:underline">Lihat Semua</a>
                        </div>
                        
                        <div class="flex flex-col items-center justify-center py-8 text-center bg-gray-50 dark:bg-slate-900/50 rounded border border-dashed border-gray-200 dark:border-slate-600">
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

@if(Auth::user()->role === 'mahasiswa')
<!-- Scripts for Exporting KTM -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    async function exportKTM(format) {
        const ktmCard = document.getElementById('ktm-card');
        const originalTransform = ktmCard.style.transform;
        
        // Reset transform temporary for clean capture
        ktmCard.style.transform = 'none';

        try {
            const canvas = await html2canvas(ktmCard, {
                scale: 3, // High quality
                useCORS: true, // Allow external images (QR Code, Avatar)
                backgroundColor: document.documentElement.classList.contains('dark') ? '#1e293b' : '#ffffff' // Match theme
            });

            const imgData = canvas.toDataURL('image/jpeg', 1.0);

            if (format === 'jpg') {
                const link = document.createElement('a');
                link.download = `KTM_{{ Auth::user()->name }}.jpg`;
                link.href = imgData;
                link.click();
            } else if (format === 'pdf') {
                const { jsPDF } = window.jspdf;
                // KTM aspect ratio (roughly width:height = 384:220 -> landscape)
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'px',
                    format: [canvas.width, canvas.height]
                });
                
                pdf.addImage(imgData, 'JPEG', 0, 0, canvas.width, canvas.height);
                pdf.save(`KTM_{{ Auth::user()->name }}.pdf`);
            }
        } catch (error) {
            console.error('Export failed:', error);
            alert('Gagal mengekspor KTM. Pastikan koneksi internet stabil.');
        } finally {
            // Restore transform
            ktmCard.style.transform = originalTransform;
        }
    }
</script>
@endif
