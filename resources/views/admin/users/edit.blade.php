<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.users.index', $role) }}" class="mr-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-primary-900 leading-tight">
                {{ __('Edit Data ' . ucfirst($role)) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded border border-gray-100">
                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.users.update', ['role' => $role, 'user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informasi Dasar -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Informasi Dasar</h3>
                            </div>

                            <div>
                                <x-input-label for="nomor_induk" :value="$role === 'dosen' ? 'NIDN / NIP' : 'NIM'" />
                                <x-text-input id="nomor_induk" name="nomor_induk" type="text" class="mt-1 block w-full bg-gray-50 text-gray-500" :value="old('nomor_induk', $user->nomor_induk)" required readonly />
                                <p class="text-xs text-gray-400 mt-1">Nomor Induk tidak bisa diubah karena digunakan sebagai ID Login.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('nomor_induk')" />
                            </div>

                            <div>
                                <x-input-label for="name" value="Nama Lengkap" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="no_telp" value="No Telp / WhatsApp" />
                                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full" :value="old('no_telp', $user->no_telp)" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_telp')" />
                            </div>

                            <div>
                                <x-input-label for="email" value="Email (Opsional)" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="avatar" value="Foto Profil (Opsional)" />
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover mb-3">
                                @endif
                                <input id="avatar" name="avatar" type="file" class="mt-1 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-primary-50 file:text-primary-700
                                    hover:file:bg-primary-100" accept="image/*" />
                                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                            </div>

                            <!-- Informasi Akademik -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Informasi Akademik</h3>
                            </div>

                            @if($role === 'mahasiswa')
                                <div>
                                    <x-input-label for="prodi" value="Program Studi" />
                                    <x-text-input id="prodi" name="prodi" type="text" class="mt-1 block w-full" :value="old('prodi', $user->prodi)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('prodi')" />
                                </div>
                                <div>
                                    <x-input-label for="kelas" value="Kelas" />
                                    <x-text-input id="kelas" name="kelas" type="text" class="mt-1 block w-full" :value="old('kelas', $user->kelas)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('kelas')" />
                                </div>
                                <div>
                                    <x-input-label for="semester" value="Semester" />
                                    <x-text-input id="semester" name="semester" type="text" class="mt-1 block w-full" :value="old('semester', $user->semester)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('semester')" />
                                </div>
                                <div>
                                    <x-input-label for="tahun_ajaran" value="Tahun Ajaran" />
                                    <x-text-input id="tahun_ajaran" name="tahun_ajaran" type="text" class="mt-1 block w-full" :value="old('tahun_ajaran', $user->tahun_ajaran)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('tahun_ajaran')" />
                                </div>
                                <div>
                                    <x-input-label for="angkatan" value="Tahun Angkatan" />
                                    <x-text-input id="angkatan" name="angkatan" type="text" class="mt-1 block w-full" :value="old('angkatan', $user->angkatan)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('angkatan')" />
                                </div>
                            @elseif($role === 'dosen')
                                <div>
                                    <x-input-label for="prodi" value="Program Studi (Homebase)" />
                                    <x-text-input id="prodi" name="prodi" type="text" class="mt-1 block w-full" :value="old('prodi', $user->prodi)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('prodi')" />
                                </div>
                                <div>
                                    <x-input-label for="mata_kuliah" value="Mata Kuliah / Bidang Keahlian" />
                                    <x-text-input id="mata_kuliah" name="mata_kuliah" type="text" class="mt-1 block w-full" :value="old('mata_kuliah', $user->mata_kuliah)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('mata_kuliah')" />
                                </div>
                            @endif

                            <!-- Keamanan -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4">Keamanan (Ganti Password)</h3>
                                <p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengganti password.</p>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="password" value="Password Baru" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full md:w-1/2" autocomplete="new-password" />
                                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-100 gap-3">
                            <a href="{{ route('admin.users.index', $role) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 transition ease-in-out duration-150">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
