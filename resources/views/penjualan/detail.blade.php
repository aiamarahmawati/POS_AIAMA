@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $sale->id)

@include('layouts.navbar')

@section('content')

<style>
    /* detail */


/* Styling Pembungkus Utama Halaman Detail */

.detail-invoice-container {
    max-width: 600px;
}


/* Tombol Kembali Minimalis */


/* GANTI KODE .btn-invoice-back YANG LAMA DENGAN INI */

.btn-invoice-back {
    font-size: 13px;
    font-weight: 500;
    background-color: #ffffff !important;
    border: 1px solid #e5e7eb !important;
    /* Garis tepi tipis halus */
    color: #4b5563 !important;
    /* Warna teks abu-abu elegan */
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    /* Efek bayangan tipis */
    transition: all 0.2s ease;
}


/* Efek saat tombol disorot kursor */

.btn-invoice-back:hover {
    background-color: #f9fafb !important;
    border-color: #d1d5db !important;
    color: #1f2937 !important;
}


/* Tombol Cetak Struk Modern */


/* GANTI KODE .btn-invoice-print YANG LAMA DENGAN INI */

.btn-invoice-print {
    font-size: 13px;
    font-weight: 600;
    background-color: #1E293B !important;
    /* Warna hitam pekat slate (Matching dengan tema POS) */
    border-color: #1E293B !important;
    color: #ffffff !important;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}


/* Efek saat tombol Cetak Struk disorot kursor (Hover) */

.btn-invoice-print:hover {
    background-color: #0F172A !important;
    /* Menjadi hitam lebih gelap saat disentuh */
    border-color: #0F172A !important;
}


/* Teks dan Fonta di Dalam Nota / Struk */

.invoice-receipt-body {
    font-family: 'Courier New', Courier, monospace;
    color: #333333;
}


/* Garis Putus-Putus Pembatas Nota */

.invoice-dashed-line {
    border-top: 1px dashed #cccccc;
    margin: 15px 0;
}


/* Ukuran Font Tabel Item Transaksi */

.table-invoice-items {
    font-size: 14px;
}


/* ==========================================================================
   CSS KHUSUS CETAK STRUK (HANYA AKTIF SAAT TOMBOL PRINT DIKLIK)
   ========================================================================== */

@media print {
    @page {
        size: auto;
        margin: 0mm;
        /* Menghapus margin default browser yang memicu tulisan header/footer */
    }
    body {
        padding: 15mm !important;
        /* Memberikan jarak kertas sendiri agar isi nota tidak terlalu mepet ke ujung potongan kertas */
    }
    /* 1. Sembunyikan semua elemen navigasi dan tombol aksi agar tidak ikut tercetak */
    nav,
    .navbar,
    #sidebar,
    .btn,
    .btn-invoice-back,
    .btn-invoice-print,
    .d-flex.justify-content-between.align-items-center.mb-3 {
        display: none !important;
    }
    /* 2. Hilangkan background abu-abu bawaan browser dan paksa warna putih bersih */
    body,
    html {
        background-color: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    /* 3. Atur kotak nota agar memenuhi ukuran kertas printer thermal */
    .detail-invoice-container {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    /* 4. Hilangkan border kotak kartu (card) dan bayangan (shadow) saat dicetak */
    .card {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
    }
    .card-body {
        padding: 10px !important;
    }
}
</style>

<div class="container mt-4 detail-invoice-container">
    
    <!-- Bagian Tombol Aksi Atas -->
        <!-- Bagian Tombol Aksi Atas (Hanya teks Kembali tanpa ikon panah) -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Tombol Kembali Bersih Tanpa Ikon -->
        <a href="{{ route('penjualan.index') }}" class="btn px-3 py-2 rounded-3 d-flex align-items-center btn-invoice-back">
            Kembali
        </a>

        <!-- Tombol Cetak Struk (Tetap sama menggunakan ikon) -->
        <button class="btn btn-primary btn-sm px-3 py-2 rounded-3 d-flex align-items-center gap-2 shadow-sm btn-invoice-print" onclick="window.print()">
            <svg xmlns="http://w3.org" width="14" height="14" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
            </svg>
            Cetak Struk
        </button>
    </div>


    <!-- Kotak Nota Transaksi -->
    <div class="card shadow-sm">
        <div class="card-body invoice-receipt-body">
            <h4 class="text-center mb-1"><strong>STRUK PENJUALAN</strong></h4>
            <p class="text-center text-muted small">ID Transaksi: #{{ $sale->id }}</p>
            <div class="invoice-dashed-line"></div>

            <div class="row small mb-2">
                <div class="col-6">Tanggal: {{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</div>
                <div class="col-6 text-end">Kasir: {{ $sale->user->name }}</div>
            </div>
            <div class="row small mb-3">
                <div class="col-6">Metode: <strong>{{ $sale->metode_pembayaran }}</strong></div>
                <div class="col-6 text-end">Status: <span class="badge bg-success">{{ $sale->status }}</span></div>
            </div>

            <div class="invoice-dashed-line"></div>
            <h6><strong>Daftar Item:</strong></h6>
            
            <table class="table table-sm table-borderless table-invoice-items">
                <thead>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->itemPenjualan as $item)
                    <tr>
                        <td>{{ $item->produk?->nama_produk ?? $item->produk?->nama ?? $item->produk?->nama_barang ?? 'Produk' }}</td>
                        <td class="text-center">{{ $item->kuantitas ?? $item->qty }}</td>
                        <td class="text-end">Rp {{ number_format($item->subtotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="invoice-dashed-line"></div>
            <div class="d-flex justify-content-between mt-2">
                <h5><strong>TOTAL BAYAR:</strong></h5>
                <h5 class="text-primary"><strong>Rp {{ number_format($sale->total_pembayaran) }}</strong></h5>
            </div>

            {{-- Tampilkan Uang Masuk & Kembalian khusus untuk transaksi Cash --}}
            @if ($sale->metode_pembayaran === 'CASH')
            <div class="row small mt-2">
                <div class="col-6">Uang Masuk:</div>
                <div class="col-6 text-end">Rp {{ number_format($sale->uang_masuk) }}</div>
            </div>
            <div class="row small">
                <div class="col-6">Kembalian:</div>
                <div class="col-6 text-end">Rp {{ number_format($sale->kembalian) }}</div>
            </div>
            @endif

            <div class="invoice-dashed-line"></div>
            <p class="text-center small text-muted mb-0">Terima kasih telah berbelanja</p>
        </div>
    </div>
</div>
@endsection