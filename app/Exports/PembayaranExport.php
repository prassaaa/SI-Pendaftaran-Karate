<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembayaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
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
        $query = Pembayaran::with(['peserta.ranting', 'verifiedBy']);

        // Apply filters
        if (isset($this->filters['status']) && $this->filters['status'] != '') {
            $query->where('status_bayar', $this->filters['status']);
        }

        if (isset($this->filters['metode']) && $this->filters['metode'] != '') {
            $query->where('metode_pembayaran', $this->filters['metode']);
        }

        if (isset($this->filters['start_date']) && $this->filters['start_date'] != '') {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if (isset($this->filters['end_date']) && $this->filters['end_date'] != '') {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        return $query->latest()->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Kode Pembayaran',
            'Kode Pendaftaran',
            'Nama Peserta',
            'Ranting',
            'Jumlah Bayar',
            'Metode Pembayaran',
            'Status Bayar',
            'Tanggal Bayar',
            'Tanggal Verifikasi',
            'Verified By',
            'Keterangan',
            'Tanggal Upload',
        ];
    }

    /**
    * @param mixed $pembayaran
    * @return array
    */
    public function map($pembayaran): array
    {
        return [
            $pembayaran->kode_pembayaran,
            $pembayaran->peserta->kode_pendaftaran,
            $pembayaran->peserta->nama_lengkap,
            $pembayaran->peserta->ranting->nama_ranting,
            'Rp ' . number_format($pembayaran->jumlah_bayar, 0, ',', '.'),
            $pembayaran->metode_pembayaran_formatted,
            ucfirst($pembayaran->status_bayar),
            $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d/m/Y H:i') : '-',
            $pembayaran->verified_at ? $pembayaran->verified_at->format('d/m/Y H:i') : '-',
            $pembayaran->verifiedBy ? $pembayaran->verifiedBy->name : '-',
            $pembayaran->keterangan ?? '-',
            $pembayaran->created_at->format('d/m/Y H:i'),
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
                        'argb' => 'FF2196F3',
                    ],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
