<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClusteringExport implements WithMultipleSheets
{
    protected $clusteringData;
    protected $statistics;

    public function __construct($clusteringData, $statistics)
    {
        $this->clusteringData = $clusteringData;
        $this->statistics = $statistics;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        // Summary sheet
        $sheets[] = new ClusteringSummarySheet($this->clusteringData, $this->statistics);

        // Individual cluster sheets
        foreach ($this->clusteringData['clusters'] as $clusterName => $cluster) {
            if (count($cluster['peserta']) > 0) {
                $sheets[] = new ClusterDetailSheet($clusterName, $cluster);
            }
        }

        return $sheets;
    }
}

class ClusteringSummarySheet implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    protected $clusteringData;
    protected $statistics;

    public function __construct($clusteringData, $statistics)
    {
        $this->clusteringData = $clusteringData;
        $this->statistics = $statistics;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = collect();

        // Add statistics
        $data->push((object)[
            'cluster_name' => 'STATISTIK UMUM',
            'age_range' => '',
            'count' => '',
            'percentage' => '',
            'avg_age' => '',
            'min_age' => '',
            'max_age' => ''
        ]);

        $data->push((object)[
            'cluster_name' => 'Total Peserta',
            'age_range' => $this->statistics['total_peserta'],
            'count' => '',
            'percentage' => '',
            'avg_age' => '',
            'min_age' => '',
            'max_age' => ''
        ]);

        $data->push((object)[
            'cluster_name' => 'Rata-rata Umur',
            'age_range' => $this->statistics['avg_age'] . ' tahun',
            'count' => '',
            'percentage' => '',
            'avg_age' => '',
            'min_age' => '',
            'max_age' => ''
        ]);

        $data->push((object)[
            'cluster_name' => 'Rentang Umur',
            'age_range' => $this->statistics['min_age'] . ' - ' . $this->statistics['max_age'] . ' tahun',
            'count' => '',
            'percentage' => '',
            'avg_age' => '',
            'min_age' => '',
            'max_age' => ''
        ]);

        // Add empty row
        $data->push((object)[
            'cluster_name' => '',
            'age_range' => '',
            'count' => '',
            'percentage' => '',
            'avg_age' => '',
            'min_age' => '',
            'max_age' => ''
        ]);

        // Add cluster summary
        $data->push((object)[
            'cluster_name' => 'RINGKASAN CLUSTER',
            'age_range' => '',
            'count' => '',
            'percentage' => '',
            'avg_age' => '',
            'min_age' => '',
            'max_age' => ''
        ]);

        foreach ($this->clusteringData['clusters'] as $name => $cluster) {
            $data->push((object)[
                'cluster_name' => $name,
                'age_range' => $cluster['min'] . '-' . $cluster['max'] . ' tahun',
                'count' => $cluster['count'],
                'percentage' => $cluster['percentage'] . '%',
                'avg_age' => $cluster['avg_age'] . ' tahun',
                'min_age' => $cluster['min_age'],
                'max_age' => $cluster['max_age']
            ]);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Cluster',
            'Rentang Usia',
            'Jumlah Peserta',
            'Persentase',
            'Rata-rata Umur',
            'Umur Termuda',
            'Umur Tertua'
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->cluster_name,
            $row->age_range,
            $row->count,
            $row->percentage,
            $row->avg_age,
            $row->min_age,
            $row->max_age
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            2 => ['font' => ['bold' => true]],
            7 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Ringkasan Clustering';
    }
}

class ClusterDetailSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    protected $clusterName;
    protected $cluster;

    public function __construct($clusterName, $cluster)
    {
        $this->clusterName = $clusterName;
        $this->cluster = $cluster;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->cluster['peserta']);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Pendaftaran',
            'Nama Lengkap',
            'Umur',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Ranting',
            'Kategori Usia',
            'No. Telepon',
            'Alamat'
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
            $peserta->umur_calculated . ' tahun',
            $peserta->tanggal_lahir->format('d/m/Y'),
            $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $peserta->ranting->nama_ranting,
            $peserta->kategoriUsia->nama_kategori,
            $peserta->no_telepon,
            $peserta->alamat
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->clusterName;
    }
}
