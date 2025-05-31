<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran - {{ $pembayaran->kode_pembayaran }}</title>
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
            background: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
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

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 16px;
            color: #666;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
            padding: 8px 0;
            border-bottom: 2px solid #e9ecef;
            text-transform: uppercase;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            display: block;
            font-size: 14px;
        }

        .info-value {
            padding: 8px 12px;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            background: #f8f9fa;
            font-size: 14px;
            color: #333;
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

        .status-paid {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-failed {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .payment-summary {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }

        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin: 20px 0;
        }

        .verification-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 12px;
        }

        @media print {
            .container {
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
            <div class="title">DETAIL PEMBAYARAN</div>
            <div class="subtitle">Ikatan Nasional Karate-Do Indonesia Cabang Kediri</div>
        </div>

        <!-- Payment Summary -->
        <div class="payment-summary">
            <div style="text-align: center; margin-bottom: 15px;">
                <div style="font-size: 16px; font-weight: bold; color: #007bff;">
                    {{ $pembayaran->kode_pembayaran }}
                </div>
                <div style="font-size: 12px; color: #666;">
                    Dibuat: {{ $pembayaran->created_at->format('d F Y, H:i:s') }}
                </div>
            </div>

            <div class="total-amount">
                {{ $pembayaran->formatted_jumlah_bayar }}
            </div>

            <div style="text-align: center;">
                <span class="status-badge status-{{ $pembayaran->status_bayar }}">
                    {{ ucfirst($pembayaran->status_bayar) }}
                </span>
            </div>
        </div>

        <!-- Peserta Information -->
        <div class="section">
            <div class="section-title">Informasi Peserta</div>
            <div class="info-grid">
                <div>
                    <div class="info-item">
                        <label class="info-label">Kode Pendaftaran</label>
                        <div class="info-value">{{ $pembayaran->peserta->kode_pendaftaran }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Nama Lengkap</label>
                        <div class="info-value">{{ $pembayaran->peserta->nama_lengkap }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Ranting</label>
                        <div class="info-value">{{ $pembayaran->peserta->ranting->nama_ranting }}</div>
                    </div>
                </div>
                <div>
                    <div class="info-item">
                        <label class="info-label">Kategori Usia</label>
                        <div class="info-value">{{ $pembayaran->peserta->kategoriUsia->nama_kategori }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">No. Telepon</label>
                        <div class="info-value">{{ $pembayaran->peserta->no_telepon }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Status Pendaftaran</label>
                        <div class="info-value">
                            <span class="status-badge status-{{ $pembayaran->peserta->status_pendaftaran }}">
                                {{ ucfirst($pembayaran->peserta->status_pendaftaran) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="section">
            <div class="section-title">Detail Pembayaran</div>
            <div class="info-grid">
                <div>
                    <div class="info-item">
                        <label class="info-label">Metode Pembayaran</label>
                        <div class="info-value">{{ $pembayaran->metode_pembayaran_formatted }}</div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Tanggal Pembayaran</label>
                        <div class="info-value">
                            {{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d F Y') : '-' }}
                        </div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Tanggal Expired</label>
                        <div class="info-value">
                            {{ $pembayaran->tanggal_expired ? $pembayaran->tanggal_expired->format('d F Y') : '-' }}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="info-item">
                        <label class="info-label">Status Pembayaran</label>
                        <div class="info-value">
                            <span class="status-badge status-{{ $pembayaran->status_bayar }}">
                                {{ ucfirst($pembayaran->status_bayar) }}
                            </span>
                        </div>
                    </div>
                    <div class="info-item">
                        <label class="info-label">Jumlah Pembayaran</label>
                        <div class="info-value" style="font-weight: bold; color: #007bff;">
                            {{ $pembayaran->formatted_jumlah_bayar }}
                        </div>
                    </div>
                    @if($pembayaran->keterangan)
                    <div class="info-item">
                        <label class="info-label">Keterangan</label>
                        <div class="info-value">{{ $pembayaran->keterangan }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Verification Information -->
        @if($pembayaran->verified_at)
        <div class="section">
            <div class="section-title">Informasi Verifikasi</div>
            <div class="verification-info">
                <div class="info-grid">
                    <div>
                        <div class="info-item">
                            <label class="info-label">Diverifikasi Oleh</label>
                            <div class="info-value">{{ $pembayaran->verifiedBy->name ?? 'Admin' }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="info-item">
                            <label class="info-label">Tanggal Verifikasi</label>
                            <div class="info-value">{{ $pembayaran->verified_at->format('d F Y, H:i:s') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Categories -->
        <div class="section">
            <div class="section-title">Kategori Pertandingan</div>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                @foreach($pembayaran->peserta->kategori_dipilih as $kategori)
                <div style="margin-bottom: 8px; display: flex; align-items: center;">
                    <span style="color: #28a745; margin-right: 10px; font-weight: bold;">✓</span>
                    <span>{{ $kategori }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>INKAI KEDIRI</strong></p>
            <p>Jl. Brawijaya No. 123, Kediri, Jawa Timur</p>
            <p>Telp: (0354) 123-456 | Email: info@inkaikediri.org</p>
            <p style="margin-top: 10px;">Dokumen ini dibuat secara otomatis pada {{ now()->format('d F Y, H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
