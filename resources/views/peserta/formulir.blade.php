<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran - {{ $peserta->kode_pendaftaran }}</title>
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
            font-size: 14px;
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
            margin-bottom: 30px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
            padding: 8px 0;
            border-bottom: 2px solid #e9ecef;
            text-transform: uppercase;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            display: block;
            font-size: 13px;
        }

        .form-value {
            padding: 8px 12px;
            border: 2px solid #e9ecef;
            border-radius: 6px;
            background: #f8f9fa;
            font-size: 14px;
            color: #333;
            min-height: 36px;
            display: flex;
            align-items: center;
        }

        .photo-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .photo-placeholder {
            width: 120px;
            height: 160px;
            border: 2px dashed #007bff;
            border-radius: 8px;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #666;
            font-size: 12px;
        }

        .categories-section {
            background: #e7f3ff;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }

        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .category-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background: white;
            border-radius: 6px;
            border: 1px solid #dee2e6;
        }

        .checkbox {
            width: 16px;
            height: 16px;
            border: 2px solid #007bff;
            border-radius: 3px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .checkbox.checked {
            background: #007bff;
            color: white;
            font-weight: bold;
        }

        .signature-section {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .signature-box {
            text-align: center;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .signature-title {
            font-weight: bold;
            margin-bottom: 60px;
            color: #555;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 10px;
            padding-top: 5px;
            font-size: 12px;
            color: #666;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #666;
            font-size: 12px;
        }

        .declaration {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-size: 13px;
            line-height: 1.5;
        }

        .declaration-title {
            font-weight: bold;
            color: #856404;
            margin-bottom: 10px;
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

            .form-grid {
                break-inside: avoid;
            }

            .form-section {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">INKAI KEDIRI</div>
            <div class="title">FORMULIR PENDAFTARAN PESERTA</div>
            <div class="subtitle">Ikatan Nasional Karate-Do Indonesia Cabang Kediri</div>
        </div>

        <!-- Kode Pendaftaran -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="background: #007bff; color: white; padding: 10px 20px; border-radius: 8px; display: inline-block; font-weight: bold; font-size: 16px;">
                KODE PENDAFTARAN: {{ $peserta->kode_pendaftaran }}
            </div>
        </div>

        <!-- Photo Section -->
        <div class="form-section">
            <div class="section-title">Foto Peserta</div>
            <div class="photo-section">
                <div class="photo-placeholder">
                    @if($peserta->foto_path)
                        <img src="{{ public_path('storage/' . $peserta->foto_path) }}" alt="Foto Peserta" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    @else
                        <div>
                            <div>FOTO</div>
                            <div>3x4</div>
                        </div>
                    @endif
                </div>
                <div style="font-size: 12px; color: #666;">Foto 3x4 cm</div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="form-section">
            <div class="section-title">Data Pribadi</div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="form-value">{{ $peserta->nama_lengkap }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <div class="form-value">{{ $peserta->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tempat Lahir</label>
                    <div class="form-value">{{ $peserta->tempat_lahir }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <div class="form-value">{{ $peserta->tanggal_lahir->format('d F Y') }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Umur</label>
                    <div class="form-value">{{ $peserta->umur }} tahun</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Golongan Darah</label>
                    <div class="form-value">{{ $peserta->golongan_darah }}</div>
                </div>
                <div class="form-group full-width">
                    <label class="form-label">Alamat Lengkap</label>
                    <div class="form-value">{{ $peserta->alamat }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <div class="form-value">{{ $peserta->no_telepon }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Berat Badan</label>
                    <div class="form-value">{{ $peserta->berat_badan }} kg</div>
                </div>
            </div>
        </div>

        <!-- Organization Information -->
        <div class="form-section">
            <div class="section-title">Data Organisasi</div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Ranting</label>
                    <div class="form-value">{{ $peserta->ranting->nama_ranting }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Usia</label>
                    <div class="form-value">{{ $peserta->kategoriUsia->nama_kategori }}</div>
                </div>
            </div>
        </div>

        <!-- Competition Categories -->
        <div class="form-section">
            <div class="section-title">Kategori Pertandingan</div>
            <div class="categories-section">
                <div class="category-grid">
                    <div class="category-item">
                        <div class="checkbox {{ $peserta->kumite_perorangan ? 'checked' : '' }}">
                            {{ $peserta->kumite_perorangan ? '✓' : '' }}
                        </div>
                        <span>Kumite Perorangan</span>
                    </div>
                    <div class="category-item">
                        <div class="checkbox {{ $peserta->kata_perorangan ? 'checked' : '' }}">
                            {{ $peserta->kata_perorangan ? '✓' : '' }}
                        </div>
                        <span>Kata Perorangan</span>
                    </div>
                    <div class="category-item">
                        <div class="checkbox {{ $peserta->kata_beregu ? 'checked' : '' }}">
                            {{ $peserta->kata_beregu ? '✓' : '' }}
                        </div>
                        <span>Kata Beregu</span>
                    </div>
                    <div class="category-item">
                        <div class="checkbox {{ $peserta->kumite_beregu ? 'checked' : '' }}">
                            {{ $peserta->kumite_beregu ? '✓' : '' }}
                        </div>
                        <span>Kumite Beregu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="form-section">
            <div class="section-title">Informasi Pembayaran</div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Total Biaya</label>
                    <div class="form-value" style="font-weight: bold; color: #007bff;">{{ $peserta->formatted_total_biaya }}</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status Pembayaran</label>
                    <div class="form-value">
                        <span style="padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold;
                            background: {{ $peserta->status_bayar === 'paid' ? '#d4edda' : ($peserta->status_bayar === 'pending' ? '#fff3cd' : '#f8d7da') }};
                            color: {{ $peserta->status_bayar === 'paid' ? '#155724' : ($peserta->status_bayar === 'pending' ? '#856404' : '#721c24') }};">
                            {{ ucfirst($peserta->status_bayar) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Declaration -->
        <div class="declaration">
            <div class="declaration-title">PERNYATAAN PESERTA:</div>
            <p>Dengan ini saya menyatakan bahwa:</p>
            <ul style="margin: 10px 0 10px 20px;">
                <li>Data yang saya berikan adalah benar dan dapat dipertanggungjawabkan</li>
                <li>Saya bersedia mengikuti seluruh rangkaian acara sesuai dengan jadwal yang telah ditetapkan</li>
                <li>Saya bersedia mematuhi seluruh peraturan dan tata tertib yang berlaku</li>
                <li>Saya membebaskan panitia dari segala risiko yang mungkin terjadi selama kegiatan</li>
            </ul>
        </div>

        <!-- Signatures -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-title">Peserta</div>
                <div style="height: 60px;"></div>
                <div class="signature-line">{{ $peserta->nama_lengkap }}</div>
            </div>
            <div class="signature-box">
                <div class="signature-title">Orang Tua / Wali</div>
                <div style="height: 60px;"></div>
                <div class="signature-line">( .............................. )</div>
            </div>
        </div>

        <!-- Official Stamp -->
        <div style="text-align: center; margin-top: 30px;">
            <div style="display: inline-block; border: 2px solid #007bff; padding: 20px; border-radius: 8px; background: #f8f9fa;">
                <div style="font-weight: bold; color: #007bff; margin-bottom: 40px;">STEMPEL PANITIA</div>
                <div style="font-size: 12px; color: #666;">Kediri, {{ now()->format('d F Y') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>INKAI KEDIRI</strong></p>
            <p>Jl. Brawijaya No. 123, Kediri, Jawa Timur</p>
            <p>Telp: (0354) 123-456 | Email: info@inkaikediri.org</p>
            <p style="margin-top: 10px;">Formulir ini dibuat secara otomatis pada {{ now()->format('d F Y, H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
