<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Clustering Umur Peserta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        
        .header h1 {
            font-size: 18px;
            margin: 0 0 5px 0;
            color: #333;
        }
        
        .header h2 {
            font-size: 16px;
            margin: 0 0 10px 0;
            color: #666;
        }
        
        .header p {
            margin: 5px 0;
            color: #888;
        }
        
        .statistics {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
        }
        
        .statistics h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 14px;
        }
        
        .stats-grid {
            display: table;
            width: 100%;
        }
        
        .stats-row {
            display: table-row;
        }
        
        .stats-cell {
            display: table-cell;
            padding: 5px 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .stats-label {
            font-weight: bold;
            width: 40%;
        }
        
        .cluster-summary {
            margin-bottom: 30px;
        }
        
        .cluster-summary h3 {
            color: #333;
            font-size: 14px;
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        .cluster-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .cluster-table th,
        .cluster-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .cluster-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            font-size: 11px;
        }
        
        .cluster-table td {
            font-size: 10px;
        }
        
        .cluster-detail {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .cluster-detail h4 {
            color: #333;
            font-size: 13px;
            margin-bottom: 10px;
            padding: 8px;
            background-color: #e9ecef;
            border-left: 4px solid #007bff;
        }
        
        .cluster-info {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        
        .cluster-info p {
            margin: 3px 0;
            font-size: 11px;
        }
        
        .peserta-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }
        
        .peserta-table th,
        .peserta-table td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }
        
        .peserta-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN CLUSTERING UMUR PESERTA</h1>
        <h2>Kejuaraan Karate INKAI Kediri {{ date('Y') }}</h2>
        <p>Tanggal Cetak: {{ date('d F Y, H:i') }} WIB</p>
        <p>Metode Clustering: {{ $clusteringData['summary'] }}</p>
    </div>

    <!-- Statistics -->
    <div class="statistics">
        <h3>Statistik Umum</h3>
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stats-cell stats-label">Total Peserta:</div>
                <div class="stats-cell">{{ $statistics['total_peserta'] }} orang</div>
            </div>
            <div class="stats-row">
                <div class="stats-cell stats-label">Rata-rata Umur:</div>
                <div class="stats-cell">{{ $statistics['avg_age'] }} tahun</div>
            </div>
            <div class="stats-row">
                <div class="stats-cell stats-label">Rentang Umur:</div>
                <div class="stats-cell">{{ $statistics['min_age'] }} - {{ $statistics['max_age'] }} tahun</div>
            </div>
            <div class="stats-row">
                <div class="stats-cell stats-label">Jumlah Cluster:</div>
                <div class="stats-cell">{{ count($clusteringData['clusters']) }} cluster</div>
            </div>
        </div>
    </div>

    <!-- Cluster Summary -->
    <div class="cluster-summary">
        <h3>Ringkasan Cluster</h3>
        <table class="cluster-table">
            <thead>
                <tr>
                    <th>Nama Cluster</th>
                    <th>Rentang Usia</th>
                    <th>Jumlah Peserta</th>
                    <th>Persentase</th>
                    <th>Rata-rata Umur</th>
                    <th>Umur Termuda</th>
                    <th>Umur Tertua</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clusteringData['clusters'] as $name => $cluster)
                <tr>
                    <td><strong>{{ $name }}</strong></td>
                    <td>{{ $cluster['min'] }}-{{ $cluster['max'] }} tahun</td>
                    <td>{{ $cluster['count'] }} orang</td>
                    <td>{{ $cluster['percentage'] }}%</td>
                    <td>{{ $cluster['avg_age'] }} tahun</td>
                    <td>{{ $cluster['min_age'] }} tahun</td>
                    <td>{{ $cluster['max_age'] }} tahun</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Detailed Cluster Data -->
    @foreach($clusteringData['clusters'] as $name => $cluster)
        @if(count($cluster['peserta']) > 0)
        <div class="cluster-detail {{ !$loop->first ? 'page-break' : '' }}">
            <h4>Cluster {{ $name }}</h4>
            
            <div class="cluster-info">
                <p><strong>Rentang Usia:</strong> {{ $cluster['min'] }}-{{ $cluster['max'] }} tahun</p>
                <p><strong>Jumlah Peserta:</strong> {{ $cluster['count'] }} orang ({{ $cluster['percentage'] }}%)</p>
                <p><strong>Rata-rata Umur:</strong> {{ $cluster['avg_age'] }} tahun</p>
                <p><strong>Rentang Umur Aktual:</strong> {{ $cluster['min_age'] }}-{{ $cluster['max_age'] }} tahun</p>
            </div>

            <table class="peserta-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Lengkap</th>
                        <th>Umur</th>
                        <th>L/P</th>
                        <th>Ranting</th>
                        <th>Kategori</th>
                        <th>No. Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cluster['peserta'] as $index => $peserta)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $peserta->kode_pendaftaran }}</td>
                        <td>{{ $peserta->nama_lengkap }}</td>
                        <td>{{ $peserta->umur_calculated }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->ranting->nama_ranting }}</td>
                        <td>{{ $peserta->kategoriUsia->nama_kategori }}</td>
                        <td>{{ $peserta->no_telepon }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endforeach

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh Sistem Informasi Pendaftaran Karate INKAI Kediri</p>
        <p>© {{ date('Y') }} INKAI Kediri - Semua hak dilindungi</p>
    </div>
</body>
</html>
