<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-900 leading-tight">
            {{ __('Kelola ' . ucfirst($role)) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded border border-gray-100">
                <div class="p-6 md:p-8 bg-white border-b border-gray-50">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Daftar {{ ucfirst($role) }}</h3>
                            <p class="text-sm text-gray-500">Kelola data, upload excel, dan hapus data {{ $role }}.</p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.users.create', $role) }}" class="inline-flex items-center px-4 py-2 bg-accent-600 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent-700 focus:bg-accent-700 active:bg-accent-800 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Data
                            </a>
                            <a href="{{ route('admin.users.template', $role) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Template Excel
                            </a>
                            <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Import Excel
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 border border-gray-100 rounded">
                            <thead class="bg-slate-50 rounded-t">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider rounded-tl">
                                        {{ $role === 'mahasiswa' ? 'NIM' : ($role === 'dosen' ? 'NIDN/NIP' : 'ID Admin/NIP') }}
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                    
                                    @if($role === 'dosen')
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mata Kuliah / Prodi</th>
                                    @elseif($role === 'mahasiswa')
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kls/Smt/Prodi</th>
                                    @else
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                                    @endif
                                    
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No HP</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider rounded-tr">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-50">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->nomor_induk ?? '-' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                            <div class="font-medium">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-400">{{ $user->email ?? 'Tidak ada email' }}</div>
                                        </td>
                                        
                                        @if($role === 'dosen')
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                            {{ $user->mata_kuliah ?? '-' }} <br>
                                            <span class="text-xs text-gray-400">{{ $user->prodi ?? '' }}</span>
                                        </td>
                                        @elseif($role === 'mahasiswa')
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                            Kelas {{ $user->kelas ?? '-' }} / Smt {{ $user->semester ?? '-' }} <br>
                                            <span class="text-xs text-gray-400">{{ $user->prodi ?? 'Prodi belum diatur' }}</span>
                                        </td>
                                        @else
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                            {{ $user->email ?? '-' }}
                                        </td>
                                        @endif
                                        
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $user->no_telp ?? '-' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.users.edit', ['role' => $role, 'user' => $user->id]) }}" class="text-accent-600 hover:text-accent-900 bg-accent-50 hover:bg-accent-100 px-3 py-1 rounded transition-colors">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                                Belum ada data {{ $role }} yang terdaftar.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div id="importModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('importModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Import Excel {{ ucfirst($role) }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 mb-4">
                                    Upload file Excel (<code>.xlsx</code>, <code>.xls</code>) yang sudah diisi sesuai dengan format template yang disediakan.
                                </p>
                                <form action="{{ route('admin.users.import', $role) }}" method="POST" enctype="multipart/form-data" id="importForm">
                                    @csrf
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded relative hover:bg-gray-50 transition-colors cursor-pointer" onclick="document.getElementById('file_excel').click()">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label for="file_excel" class="relative cursor-pointer bg-transparent rounded font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                                    <span>Pilih File Excel</span>
                                                    <input id="file_excel" name="file_excel" type="file" class="sr-only" required accept=".xlsx, .xls, .csv" onchange="document.getElementById('file-name').textContent = this.files[0].name; document.getElementById('file-name').classList.add('text-primary-600', 'font-bold')">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500" id="file-name">XLSX, XLS up to 2MB</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end gap-2">
                                        <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="px-4 py-2 bg-white border border-gray-300 rounded font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">Batal</button>
                                        <button type="submit" class="px-4 py-2 bg-primary-600 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-primary-700 transition ease-in-out duration-150" onclick="this.innerHTML='Mengupload...'; this.form.submit(); this.disabled=true;">Upload Sekarang</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
