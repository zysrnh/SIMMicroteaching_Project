<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersTemplateExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function array(): array
    {
        // Berikan 1 baris contoh/dummy agar user tahu format isiannya
        if ($this->role === 'mahasiswa') {
            return [
                ['1234567890', 'Budi Santoso', 'PAI-A', '6', '2025/2026', '2023', '081234567890', 'PAI'],
            ];
        } else {
            return [
                ['0987654321', 'Dr. Siti Aminah, M.Pd.', '081298765432', 'siti@iaipersis.ac.id', 'Microteaching', 'PAI'],
            ];
        }
    }

    public function headings(): array
    {
        if ($this->role === 'mahasiswa') {
            return [
                'NIM', 'Nama Lengkap', 'Kelas', 'Semester', 'Tahun Ajaran', 'Angkatan', 'No Telp/WA', 'Program Studi'
            ];
        } else {
            return [
                'NIDN/NIP', 'Nama Lengkap (beserta Gelar)', 'No Telp/WA', 'Email', 'Mata Kuliah', 'Program Studi'
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
