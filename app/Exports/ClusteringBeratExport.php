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

class ClusteringBeratExport implements WithMultipleSheets
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
        $sheets[] = new ClusteringBeratSummarySheet($this->clusteringData, $this->statistics);

        // Individual cluster sheets
        foreach ($this->clusteringData['clusters'] as $clusterName => $cluster) {
            if (count($cluster['peserta']) > 0) {
                $sheets[] = new ClusterBeratDetailSheet($clusterName, $cluster);
            }
        }

        return $sheets;
    }
}

class ClusteringBeratSummarySheet implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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
            'weight_range' => '',
            'count' => '',
            'percentage' => '',
            'avg_weight' => '',
            'min_weight' => '',
            'max_weight' => ''
        ]);

        $data->push((object)[
            'cluster_name' => 'Total Peserta',
            'weight_range' => $this->statistics['total_peserta'],
            'count' => '',
            'percentage' => '',
            'avg_weight' => '',
            'min_weight' => '',
            'max_weight' => ''
        ]);

        $data->push((object)[
            'cluster_name' => 'Rata-rata Berat',
            'weight_range' => $this->statistics['avg_weight'] . ' kg',
            'count' => '',
            'percentage' => '',
            'avg_weight' => '',
            'min_weight' => '',
            'max_weight' => ''
        ]);

        $data->push((object)[
            'cluster_name' => 'Rentang Berat',
            'weight_range' => $this->statistics['min_weight'] . ' - ' . $this->statistics['max_weight'] . ' kg',
            'count' => '',
            'percentage' => '',
            'avg_weight' => '',
            'min_weight' => '',
            'max_weight' => ''
        ]);

        // Add empty row
        $data->push((object)[
            'cluster_name' => '',
            'weight_range' => '',
            'count' => '',
            'percentage' => '',
            'avg_weight' => '',
            'min_weight' => '',
            'max_weight' => ''
        ]);

        // Add cluster summary
        $data->push((object)[
            'cluster_name' => 'RINGKASAN CLUSTER BERAT BADAN',
            'weight_range' => '',
            'count' => '',
            'percentage' => '',
            'avg_weight' => '',
            'min_weight' => '',
            'max_weight' => ''
        ]);

        foreach ($this->clusteringData['clusters'] as $name => $cluster) {
            $maxWeight = $cluster['max'] > 100 ? '∞' : $cluster['max'];
            $data->push((object)[
                'cluster_name' => $name,
                'weight_range' => $cluster['min'] . '-' . $maxWeight . ' kg',
                'count' => $cluster['count'],
                'percentage' => $cluster['percentage'] . '%',
                'avg_weight' => $cluster['avg_weight'] . ' kg',
                'min_weight' => $cluster['min_weight'],
                'max_weight' => $cluster['max_weight']
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
            'Rentang Berat',
            'Jumlah Peserta',
            'Persentase',
            'Rata-rata Berat',
            'Berat Teringan',
            'Berat Terberat'
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
            $row->weight_range,
            $row->count,
            $row->percentage,
            $row->avg_weight,
            $row->min_weight,
            $row->max_weight
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
        return 'Ringkasan Clustering Berat';
    }
}

class ClusterBeratDetailSheet implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
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
            'Berat Badan',
            'Umur',
            'Jenis Kelamin',
            'Tanggal Lahir',
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
            $peserta->berat_badan . ' kg',
            $peserta->umur_calculated . ' tahun',
            $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $peserta->tanggal_lahir->format('d/m/Y'),
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

