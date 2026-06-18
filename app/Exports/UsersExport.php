<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function collection()
    {
        return User::where('role', $this->role)->latest()->get();
    }

    public function headings(): array
    {
        if ($this->role === 'mahasiswa') {
            return [
                'NIM', 'Nama Lengkap', 'Email', 'No Telp/WA', 'Program Studi', 'Kelas', 'Semester', 'Tahun Ajaran', 'Angkatan'
            ];
        } elseif ($this->role === 'admin') {
            return [
                'ID Admin / NIP', 'Nama Lengkap', 'Email', 'No Telp/WA'
            ];
        } else {
            // Dosen
            return [
                'NIDN/NIP', 'Nama Lengkap', 'Email', 'No Telp/WA', 'Program Studi (Homebase)', 'Mata Kuliah / Bidang Keahlian'
            ];
        }
    }

    public function map($user): array
    {
        if ($this->role === 'mahasiswa') {
            return [
                $user->nomor_induk,
                $user->name,
                $user->email,
                $user->no_telp,
                $user->prodi,
                $user->kelas,
                $user->semester,
                $user->tahun_ajaran,
                $user->angkatan,
            ];
        } elseif ($this->role === 'admin') {
            return [
                $user->nomor_induk,
                $user->name,
                $user->email,
                $user->no_telp,
            ];
        } else {
            // Dosen
            return [
                $user->nomor_induk,
                $user->name,
                $user->email,
                $user->no_telp,
                $user->prodi,
                $user->mata_kuliah,
            ];
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style header row (Row 1)
            1    => ['font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF047857']]],
        ];
    }
}
