<?php

namespace App\Exports;

use App\Models\Peserta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesertaExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Peserta::with(['ranting', 'kategoriUsia', 'user']);

        // Apply filters
        if (isset($this->filters['status_pendaftaran']) && $this->filters['status_pendaftaran'] != '') {
            $query->where('status_pendaftaran', $this->filters['status_pendaftaran']);
        }

        if (isset($this->filters['status_bayar']) && $this->filters['status_bayar'] != '') {
            $query->where('status_bayar', $this->filters['status_bayar']);
        }

        if (isset($this->filters['ranting_id']) && $this->filters['ranting_id'] != '') {
            $query->where('ranting_id', $this->filters['ranting_id']);
        }

        return $query->latest()->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Kode Pendaftaran',
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Umur',
            'Jenis Kelamin',
            'Alamat',
            'No. Telepon',
            'Golongan Darah',
            'Berat Badan (KG)',
            'Ranting',
            'Kategori Usia',
            'Kumite Perorangan',
            'Kata Perorangan',
            'Kata Beregu',
            'Kumite Beregu',
            'Total Biaya',
            'Status Pendaftaran',
            'Status Bayar',
            'Email',
            'Tanggal Daftar',
        ];
    }

    /**
    * @param mixed $peserta
    * @return array
    */
    public function map($peserta): array
    {
        return [
            $peserta->kode_pendaftaran,
            $peserta->nama_lengkap,
            $peserta->tempat_lahir,
            $peserta->tanggal_lahir->format('d/m/Y'),
            $peserta->umur . ' tahun',
            $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $peserta->alamat,
            $peserta->no_telepon,
            $peserta->golongan_darah,
            $peserta->berat_badan,
            $peserta->ranting->nama_ranting,
            $peserta->kategoriUsia->nama_kategori,
            $peserta->kumite_perorangan ? 'Ya' : 'Tidak',
            $peserta->kata_perorangan ? 'Ya' : 'Tidak',
            $peserta->kata_beregu ? 'Ya' : 'Tidak',
            $peserta->kumite_beregu ? 'Ya' : 'Tidak',
            'Rp ' . number_format($peserta->total_biaya, 0, ',', '.'),
            ucfirst($peserta->status_pendaftaran),
            ucfirst($peserta->status_bayar),
            $peserta->user->email,
            $peserta->created_at->format('d/m/Y H:i'),
        ];
    }

    /**
    * @param Worksheet $sheet
    * @return array
    */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FF4CAF50',
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
