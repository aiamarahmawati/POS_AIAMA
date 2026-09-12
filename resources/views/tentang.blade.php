@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Tentang')

@include('layouts.navbar')
<!-- batas awal isi konten -->
@section('content')

    <style>
        /* ==========================================================================
       KHUSUS STYLING HALAMAN TENTANG (versi ringkas tanpa judul section)
       ========================================================================== */

        body {
            background-color: #F8F9FA !important;
        }

        .tentang-wrapper {
            max-width: 720px;
            margin: 0 auto;
        }

        .card {
            background: #FFFFFF !important;
            border: 1px solid #E2E8F0 !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03) !important;
            margin-bottom: 20px !important;
        }

        .card .card-header {
            background: #F8FAFC !important;
            border-bottom: 1px solid #E2E8F0 !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            color: #1E293B !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 16px !important;
        }

        .card .card-body {
            padding: 24px !important;
        }

        .card-body p {
            font-size: 14px;
            line-height: 1.8;
            color: #334155;
            margin: 0;
            text-align: left;
        }

        /* Kartu Profil Pembuat: foto bulat + nama, dalam satu kotak */
        .profil-pembuat {
            text-align: center;
        }

        .foto-profil {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            border: 4px solid #2563EB;
            object-fit: cover;
            margin-bottom: 16px;
        }

        .profil-pembuat h5 {
            font-size: 19px;
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 4px;
        }

        .profil-pembuat p {
            font-size: 14px;
            color: #64748B;
            margin-bottom: 2px;
            text-align: center;
        }

        /* Fitur Utama: grid 2 kolom */
        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4px 24px;
        }

        .feature-grid .feature-item {
            font-size: 14px;
            color: #334155;
            padding: 8px 0;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature-grid .feature-item i {
            color: #2563EB;
            font-size: 12px;
        }

        @media (max-width: 576px) {
            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        .footer-copyright {
            text-align: center;
            padding: 24px 0 8px;
            color: #94A3B8;
            font-size: 13px;
        }
    </style>

    <div class="dashboard-page-wrapper">
        <div class="container py-4">
            <div class="tentang-wrapper">

                <!-- Profil Pembuat -->
                <div class="card">
                    <div class="card-body profil-pembuat">
                        <img src="{{ asset('assets/images/aiw.jpeg') }}" alt="Foto Profil" class="foto-profil"
                            onerror="this.src='https://via.placeholder.com/130?text=Foto'">
                        <h5>Ai Rahmawati</h5>
                    </div>
                </div>

                <!-- Deskripsi Aplikasi -->
                <div class="card">
                    <div class="card-header text-center">
                        Kedai Mercon
                    </div>
                    <div class="card-body">
                        <p>
                            Kedai Mercon adalah aplikasi manajemen penjualan dan inventaris berbasis web
                            yang dirancang untuk membantu pemilik usaha mencatat transaksi penjualan,
                            memantau stok produk secara real-time, serta melihat ringkasan penjualan
                            harian melalui dashboard yang informatif.
                        </p>
                    </div>
                </div>

                <!-- Fitur Utama -->
                <div class="card">
                    <div class="card-header text-center">
                        Fitur Utama
                    </div>
                    <div class="card-body">
                        <div class="feature-grid">
                            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Dashboard ringkasan penjualan harian</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Notifikasi stok rendah & stok habis</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Manajemen data pengguna (Users)</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Manajemen jenis produk</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Manajemen data produk & stok</div>
                            <div class="feature-item"><i class="bi bi-check-circle-fill"></i> Pencatatan transaksi penjualan</div>
                            
                        </div>
                    </div>
                </div>

                <div class="footer-copyright">
                    &copy; {{ date('Y') }} Kedai Mercon.
                </div>

            </div>
        </div>
    </div>

    <!-- batas akhir isi konten -->
@endsection