<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function model(array $row)
    {
        // $row diakses menggunakan index numeric, misal 0, 1, 2, dll karena tanpa HeadingRow trait
        // Asumsi baris pertama adalah header, kita skip menggunakan fitur `WithStartRow` atau cek index.
        
        // Skip header manual
        // Skip header manual
        if ($row[0] === 'NIM' || $row[0] === 'NIDN/NIP' || $row[0] === 'NIDN' || str_contains($row[0], 'ID Admin')) {
            return null;
        }

        return new User([
            'role'         => $this->role,
            'nomor_induk'  => $row[0],
            'name'         => $row[1],
            'password'     => bcrypt((string) $row[0]), // Password = nomor_induk
            
            // Cek kondisi berdasar role
            'kelas'        => $this->role === 'mahasiswa' ? ($row[2] ?? null) : null,
            'semester'     => $this->role === 'mahasiswa' ? ($row[3] ?? null) : null,
            'tahun_ajaran' => $this->role === 'mahasiswa' ? ($row[4] ?? null) : null,
            'angkatan'     => $this->role === 'mahasiswa' ? ($row[5] ?? null) : null,
            'no_telp'      => $this->role === 'mahasiswa' ? ($row[6] ?? null) : ($row[2] ?? null),
            'email'        => ($this->role === 'dosen' || $this->role === 'admin') ? ($row[3] ?? null) : null,
            'mata_kuliah'  => $this->role === 'dosen' ? ($row[4] ?? null) : null,
            'prodi'        => $this->role === 'dosen' ? ($row[5] ?? null) : ($this->role === 'mahasiswa' ? ($row[7] ?? null) : null),
        ]);
    }
}
