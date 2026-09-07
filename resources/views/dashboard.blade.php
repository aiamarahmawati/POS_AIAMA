@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Dashboard')

@include('layouts.navbar')
<!-- batas awal isi konten  -->
@section('content')

    <style>
        /* ==========================================================================
       2. KHUSUS STYLING HALAMAN DASHBOARD (VERSI PASTI KEMBALI KE TENGAH)
       ========================================================================== */


        /* Pengaturan Dasar Latar Belakang */

        body {
            background-color: #F8F9FA !important;
        }


        /* KODE PEMAKSA: Menghancurkan total sisa rata kiri pada 4 kotak atas */

        .card-header,
        div.card-header,
        .card-body,
        div.card-body,
        h5.card-title {
            text-align: center !important;
            /* Paksa semua elemen teks di dalam kotak rata tengah */
        }


        /* Memastikan nominal angka besar tetap berbobot dan pas di tengah */

        h5.card-title {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: #1E293B !important;
            margin: 0 auto !important;
            display: block !important;
            width: 100% !important;
        }


        /* Mengunci tinggi 4 kotak atas agar tipis dan rapi */

        .row .card {
            background: #FFFFFF !important;
            border: 1px solid #E2E8F0 !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.03) !important;
            overflow: hidden !important;
            margin-bottom: 12px !important;
            height: 90px !important;
            min-height: 90px !important;
        }


        /* Menyusutkan Kepala Kotak Ringkasan */

        .row .card .card-header {
            background: #F8FAFC !important;
            border-bottom: 1px solid #E2E8F0 !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            color: #64748B !important;
            padding: 6px 12px !important;
            height: 32px !important;
        }


        /* Menyusutkan Badan Kotak Ringkasan & Mengunci Flexbox ke Tengah */

        .row .card .card-body {
            padding: 8px 12px !important;
            height: 56px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            /* Paksa angka berada tepat di tengah horizontal */
        }


        /* Typography Judul Bagian Halaman */

        h1 {
            font-weight: 700;
            font-size: 26px;
            color: #1E293B;
            margin-bottom: 24px;
        }

        h1 small {
            font-weight: 400;
            color: #64748B;
            font-size: 15px;
        }

        h2 {
            font-size: 15px;
            font-weight: 700;
            color: #1E293B;
            margin: 36px 0 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #E2E8F0;
            text-align: left !important;
            /* Biarkan sub-judul section tetap di kiri */
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        h3 {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            text-align: left !important;
            /* Biarkan sub-judul tabel tetap di kiri */
            margin: 12px 0 12px;
        }


        /* Kustomisasi Tabel Laporan di Bawah (DIPAKSA TETAP RATA KIRI AGAR NYAMAN DIBACA) */

        .table {
            border-color: #E2E8F0 !important;
            background-color: #FFFFFF !important;
            margin-top: 10px;
        }

        .table thead th {
            background-color: #F8FAFC !important;
            color: #64748B !important;
            font-size: 13px;
            font-weight: 600;
            padding: 12px 16px !important;
            border-bottom: 2px solid #E2E8F0 !important;
            text-align: left !important;
            /* Paksa judul kolom tabel rata kiri */
        }

        .table tbody td,
        .table tbody th {
            padding: 12px 16px !important;
            color: #334155 !important;
            font-size: 14px;
            border-bottom: 1px solid #F1F5F9 !important;
            text-align: left !important;
            /* Paksa isi data tabel rata kiri */
        }

        .table th,
        .table td {
            text-align: left !important;
        }


        /* Pewarnaan Khusus Status Kritis */

        .text-danger-custom {
            color: #EF4444 !important;
            font-weight: 600;
        }

        .text-warning-custom {
            color: #F59E0B !important;
            font-weight: 600;
        }
    </style>

    <!-- KODE TAMBAHAN: Membuka kelas pengunci khusus halaman dashboard -->
    <div class="dashboard-page-wrapper">

        <div class="container py-4 text-center">
            <div class="container py-4">
                <div class="text-center mb-4">
                    <h1>
                        Ringkasan Hari Ini
                        <small class="text-muted">
                            ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
                        </small>
                    </h1>
                </div>
                <!-- ... sisanya biarkan di dalam row ... -->
                <div class="row">
                    @can('viewAny', App\Models\User::class)
                        <div class="col-md-12">
                            <h2>Penjualan Hari Ini</h2>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header">
                                    Total Nilai Penjualan Hari ini
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-header">
                                    Jumlah Transaksi Hari ini
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $ringkasan['total_transaksi'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Status Pembayaran</h2>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Total Pembayaran Tunai
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Total Pembayaran Non-Tunai
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="row">
                    <div class="col-md-12">
                        <h2>Status Inventaris Kritis</h2>
                    </div>
                    <div class="col-md-6">
                        <h3>Daftar produk stok rendah</h3>
                        <table class="table table-hover align-middle mt-2">
                            <thead>
                                <tr>
                                    <!-- Tambahkan text-start pada judul kolom -->
                                    <th scope="col" class="text-start">No</th>
                                    <th scope="col" class="text-start">Nama</th>
                                    <th scope="col" class="text-start">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                    <tr>
                                        <!-- Pastikan td atau th di sini juga text-start -->
                                        <th class="text-start">{{ $produkStokRendah->firstItem() + $index }}</th>
                                        <td class="text-start">{{ $produk->nama }}</td>
                                        <td class="text-start">
                                            <span class="text-warning-custom">{{ $produk->stok }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $produkStokRendah->links() }}
                    </div>
                    <div class="col-md-6">
                        <h3>Produk habis stok</h3>
                        <table class="table table-hover align-middle mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                    <tr>
                                        <th>{{ $produkStokHabis->firstItem() + $index }}</th>
                                        <td>{{ $produk->nama }}</td>
                                        <!-- Cari bagian ini di baris stok habis, tambahkan class text-danger-custom -->
                                        <td><span class="text-danger-custom">{{ $produk->stok }}</span></td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $produkStokHabis->links() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Produk Terlaris</h2>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover align-middle mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Unit Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkTerlaris as $produk)
                                    <tr>
                                        <th>{{ $produk->nama }}</th>
                                        <td>{{ $produk->stok }}</td>
                                        <td>{{ $produk->total_terjual }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Belum ada produk yang terjual hari ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- KODE TAMBAHAN: Menutup kelas pengunci khusus halaman dashboard -->

    <!-- batas akhir isi konten  -->
@endsection
