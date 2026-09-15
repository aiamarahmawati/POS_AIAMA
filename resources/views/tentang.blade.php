@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Tentang')

@include('layouts.navbar')
<!-- batas awal isi konten -->
@section('content')

<style>
    /* ==========================================================================
       KHUSUS STYLING HALAMAN TENTANG
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

    /* Logo Kedai Mercon - samain dengan navbar (kotak gelap + icon api oranye) */
    .logo-kedai {
        text-align: center;
    }

    .logo-badge {
        width: 64px;
        height: 64px;
        background-color: #1E293B;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
    }

    .logo-badge i {
        font-size: 32px;
        color: #F97316;
    }

    .logo-kedai h5 {
        font-size: 20px;
        font-weight: 800;
        color: #1E293B;
        margin-bottom: 2px;
    }

    .logo-kedai p {
        font-size: 13px;
        color: #64748B;
        text-align: center;
    }

    /* Produk yang tersedia: grid 2 kolom */
    .produk-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4px 24px;
    }

    .produk-grid .produk-item {
        font-size: 14px;
        color: #334155;
        padding: 8px 0;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .produk-grid .produk-item i {
        color: #DC2626;
        font-size: 14px;
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

        .feature-grid,
        .produk-grid {
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

            <!-- Logo & Nama Kedai -->
            <div class="card">
                <div class="card-body logo-kedai">
                    <div class="logo-badge">
                        <i class="bi bi-fire"></i>
                    </div>
                    <h5>Kedai Mercon</h5>
                </div>
            </div>

            <!-- Deskripsi Aplikasi -->
            <div class="card">
                <div class="card-header text-center">
                    Tentang Kedai Mercon
                </div>
                <div class="card-body">
                    <p>
                        Kedai Mercon adalah usaha kuliner yang menyajikan makanan super pedas dan
                        minuman segar, yang dikelola menggunakan aplikasi manajemen penjualan berbasis web.
                        Aplikasi ini membantu pemilik usaha mencatat
                        transaksi penjualan, memantau stok produk, serta melihat
                        ringkasan penjualan harian melalui dashboard.
                    </p>
                </div>
            </div>

            <!-- Produk yang Tersedia -->
            <div class="card">
                <div class="card-header text-center">
                    Tersedia
                </div>
                <div class="card-body">
                    <div class="produk-grid">
                        <div class="produk-item"><i class="bi bi-fire"></i> Aneka makanan super pedas</div>
                        <div class="produk-item"><i class="bi bi-cup-straw"></i> Aneka minuman segar</div>
                    </div>
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

            <!-- Alamat -->
            <div class="card shadow-sm">
                <div class="card-header text-center fw-bold bg-white py-3">
                    ALAMAT KEDAI
                </div>
                <div class="card-body text-center py-4">
                    <!-- Menggunakan d-flex agar ikon dan teks sejajar di tengah -->
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="bi bi-geo-alt-fill me-2 fs-5" style="color:#2563EB;"></i>
                        <span class="text-secondary">
                            Jl. Babakan Siliwangi, Setiaratu, Kec. Cibeureum, Kab. Tasikmalaya, Jawa Barat, 46196
                        </span>
                    </div>
                    <!-- <small class="text-danger d-block mt-3 fw-medium">
                        *Sementara hanya melayani pesanan online (Delivery & COD)*
                    </small> -->
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