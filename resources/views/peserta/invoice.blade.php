<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $peserta->kode_pendaftaran }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            color: #666;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-left, .invoice-right {
            width: 48%;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }

        .participant-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 5px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #666;
            font-size: 14px;
        }

        .detail-value {
            font-size: 16px;
            color: #333;
        }

        .categories {
            margin-bottom: 30px;
        }

        .category-list {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }

        .category-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .category-item:last-child {
            margin-bottom: 0;
        }

        .check-icon {
            color: #28a745;
            margin-right: 10px;
            font-weight: bold;
        }

        .payment-summary {
            background: #fff;
            border: 2px solid #007bff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            padding-top: 15px;
            border-top: 2px solid #e9ecef;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-approved {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-paid {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .status-unpaid {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 14px;
        }

        .qr-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        @media print {
            body {
                background: white;
            }

            .container {
                box-shadow: none;
                padding: 20px;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">INKAI KEDIRI</div>
            <div class="subtitle">Ikatan Nasional Karate-Do Indonesia Cabang Kediri</div>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div class="invoice-left">
                <div class="invoice-title">INVOICE</div>
                <div class="info-row">
                    <span class="info-label">No. Invoice:</span>
                    <span>INV-{{ $peserta->kode_pendaftaran }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal:</span>
                    <span>{{ $peserta->created_at->format('d F Y') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jatuh Tempo:</span>
                    <span>{{ $peserta->created_at->addDays(7)->format('d F Y') }}</span>
                </div>
            </div>
            <div class="invoice-right" style="text-align: right;">
                <div style="margin-bottom: 15px;">
                    <span class="status-badge status-{{ $peserta->status_pendaftaran }}">
                        {{ ucfirst($peserta->status_pendaftaran) }}
                    </span>
                    <span class="status-badge status-{{ $peserta->status_bayar }}">
                        {{ ucfirst($peserta->status_bayar) }}
                    </span>
                </div>
                <div style="font-size: 14px; color: #666; line-height: 1.4;">
                    <strong>INKAI Kediri</strong><br>
                    Jl. Brawijaya No. 123<br>
                    Kediri, Jawa Timur<br>
                    Telp: (0354) 123-456
                </div>
            </div>
        </div>

        <!-- Participant Information -->
        <div class="participant-info">
            <div class="section-title">Informasi Peserta</div>
            <div class="details-grid">
                <div>
                    <div class="detail-item">
                        <div class="detail-label">Kode Pendaftaran</div>
                        <div class="detail-value">{{ $peserta->kode_pendaftaran }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">{{ $peserta->nama_lengkap }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tempat, Tanggal Lahir</div>
                        <div class="detail-value">{{ $peserta->tempat_tanggal_lahir }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-value">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                    </div>
                </div>
                <div>
                    <div class="detail-item">
                        <div class="detail-label">Ranting</div>
                        <div class="detail-value">{{ $peserta->ranting->nama_ranting }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Kategori Usia</div>
                        <div class="detail-value">{{ $peserta->kategoriUsia->nama_kategori }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Berat Badan</div>
                        <div class="detail-value">{{ $peserta->berat_badan }} kg</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">No. Telepon</div>
                        <div class="detail-value">{{ $peserta->no_telepon }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="categories">
            <div class="section-title">Kategori Pertandingan</div>
            <div class="category-list">
                @foreach($peserta->kategori_dipilih as $kategori)
                <div class="category-item">
                    <span class="check-icon">✓</span>
                    <span>{{ $kategori }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="payment-summary">
            <div class="section-title">Rincian Pembayaran</div>

            @php
                $biayaPerKategori = [
                    'Kumite Perorangan' => 50000,
                    'Kata Perorangan' => 40000,
                    'Kata Beregu' => 75000,
                    'Kumite Beregu' => 75000
                ];
            @endphp

            @foreach($peserta->kategori_dipilih as $kategori)
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <span>{{ $kategori }}</span>
                <span>Rp {{ number_format($biayaPerKategori[$kategori] ?? 50000, 0, ',', '.') }}</span>
            </div>
            @endforeach

            <div class="total-row">
                <span>TOTAL PEMBAYARAN</span>
                <span>{{ $peserta->formatted_total_biaya }}</span>
            </div>
        </div>

        <!-- QR Code Section -->
        <div class="qr-section">
            <div class="section-title">Kode QR untuk Verifikasi</div>
            <div style="font-family: monospace; font-size: 12px; background: white; padding: 10px; border-radius: 4px; display: inline-block;">
                {{ $peserta->kode_pendaftaran }}
            </div>
            <div style="margin-top: 10px; font-size: 12px; color: #666;">
                Scan atau tunjukkan kode ini saat verifikasi
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih atas partisipasi Anda dalam kejuaraan INKAI Kediri!</strong></p>
            <p>Dokumen ini dibuat secara otomatis pada {{ now()->format('d F Y, H:i:s') }}</p>
            <p>Untuk informasi lebih lanjut, hubungi sekretariat INKAI Kediri</p>
        </div>
    </div>
</body>
</html>
