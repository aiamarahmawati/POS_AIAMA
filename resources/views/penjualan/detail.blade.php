@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $sale->id)

@include('layouts.navbar')

@section('content')

<style>
    /* ==========================================================================
       Halaman Detail Struk - Tampilan ala Kertas Struk (Thermal Receipt)
       ========================================================================== */

    .detail-invoice-container {
        max-width: 600px;
    }

    /* Tombol Kembali Minimalis */
    .btn-invoice-back {
        font-size: 13px;
        font-weight: 500;
        background-color: #ffffff !important;
        border: 1px solid #e5e7eb !important;
        color: #4b5563 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    .btn-invoice-back:hover {
        background-color: #f9fafb !important;
        border-color: #d1d5db !important;
        color: #1f2937 !important;
    }

    /* Tombol Cetak Struk Modern */
    .btn-invoice-print {
        font-size: 13px;
        font-weight: 600;
        background-color: #1E293B !important;
        border-color: #1E293B !important;
        color: #ffffff !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }

    .btn-invoice-print:hover {
        background-color: #0F172A !important;
        border-color: #0F172A !important;
    }

    /* ------------------------------------------------------------------------
       Kertas Struk
       ------------------------------------------------------------------------ */

    .receipt-wrapper {
        display: flex;
        justify-content: center;
    }

    /* Baris tombol dibuat selebar kertas struk (380px) agar sejajar */
    .invoice-actions-row {
        max-width: 380px;
        margin-left: auto;
        margin-right: auto;
    }

    .receipt-paper {
        width: 100%;
        max-width: 380px;
        background-color: #ffffff;
        padding: 32px 26px 26px;
        font-family: 'Courier New', Courier, monospace;
        color: #374151;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        position: relative;
    }

    /* Efek sobekan / zigzag di bagian bawah kertas struk */
    .receipt-paper::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: -10px;
        height: 10px;
        background:
            linear-gradient(-45deg, #ffffff 6px, transparent 0),
            linear-gradient(45deg, #ffffff 6px, transparent 0);
        background-size: 12px 12px;
        background-repeat: repeat-x;
        background-position: left bottom;
    }

    .receipt-title {
        text-align: center;
        font-size: 17px;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #1f2937;
        margin-bottom: 2px;
    }

    .receipt-subtitle {
        text-align: center;
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 18px;
    }

    .receipt-meta-row {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 7px;
    }

    .receipt-meta-row span:first-child {
        color: #374151;
        font-weight: 500;
    }

    .receipt-status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 1px 8px;
        border-radius: 999px;
        text-transform: uppercase;
    }

    .receipt-status-completed {
        background-color: #dcfce7;
        color: #15803d;
    }

    .receipt-status-pending {
        background-color: #fef9c3;
        color: #a16207;
    }

    .receipt-status-other {
        background-color: #e5e7eb;
        color: #374151;
    }

    .receipt-dashed {
        border: none;
        border-top: 1.5px dashed #d1d5db;
        margin: 16px 0;
    }

    .receipt-item-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .receipt-item-row:last-child {
        margin-bottom: 0;
    }

    .receipt-item-name {
        flex: 1;
        padding-right: 10px;
        color: #111827;
    }

    .receipt-item-qty {
        width: 34px;
        text-align: right;
        color: #4b5563;
        flex-shrink: 0;
    }

    .receipt-item-total {
        width: 100px;
        text-align: right;
        color: #111827;
        flex-shrink: 0;
    }

    .receipt-summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 8px;
    }

    .receipt-summary-row:last-child {
        margin-bottom: 0;
    }

    .receipt-total-row {
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }

    .receipt-thanks {
        text-align: center;
        font-size: 13.5px;
        font-weight: 600;
        color: #374151;
        margin-top: 4px;
    }

    /* ==========================================================================
       CSS KHUSUS CETAK STRUK (HANYA AKTIF SAAT TOMBOL PRINT DIKLIK)
       ========================================================================== */
    @media print {
        @page {
            size: auto;
            margin: 0mm;
        }

        body {
            padding: 15mm !important;
        }

        nav,
        .navbar,
        #sidebar,
        .btn,
        .btn-invoice-back,
        .btn-invoice-print,
        .invoice-actions-row {
            display: none !important;
        }

        body,
        html {
            background-color: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .detail-invoice-container {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .receipt-paper {
            box-shadow: none !important;
            max-width: 100% !important;
            padding: 0 !important;
        }

        .receipt-paper::after {
            display: none !important;
        }
    }
</style>

<div class="container mt-4 detail-invoice-container">

    <!-- Bagian Tombol Aksi Atas -->
    <div class="d-flex justify-content-between align-items-center mb-3 invoice-actions-row">
        <a href="{{ route('penjualan.index') }}" class="btn px-3 py-2 rounded-3 d-flex align-items-center btn-invoice-back">
            Kembali
        </a>

        <button class="btn btn-primary btn-sm px-3 py-2 rounded-3 d-flex align-items-center gap-2 shadow-sm btn-invoice-print" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
            </svg>
            Cetak Struk
        </button>
    </div>

    <!-- Kertas Struk -->
    <div class="receipt-wrapper">
        <div class="receipt-paper">

            <div class="receipt-title"><h4>KEDAI MERCON</h4></div>
            <div class="receipt-subtitle">No Transaksi: {{ $sale->id }}</div>

            <div class="receipt-meta-row">
                <span>Tanggal</span>
                <span>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
            </div>
            <div class="receipt-meta-row">
                <span>Kasir</span>
                <span>{{ $sale->user->name }}</span>
            </div>
            <div class="receipt-meta-row">
                <span>Metode</span>
                <span>{{ $sale->metode_pembayaran }}</span>
            </div>
            <div class="receipt-meta-row">
                <span>Status</span>
                <span>
                    @php
                        $statusClass = match(strtoupper($sale->status)) {
                            'COMPLETED' => 'receipt-status-completed',
                            'PENDING' => 'receipt-status-pending',
                            default => 'receipt-status-other',
                        };
                    @endphp
                    <span class="receipt-status-badge {{ $statusClass }}">{{ $sale->status }}</span>
                </span>
            </div>

            <hr class="receipt-dashed">

            @foreach($sale->itemPenjualan as $item)
            <div class="receipt-item-row">
                <div class="receipt-item-name">
                    {{ $item->produk?->nama_produk ?? $item->produk?->nama ?? $item->produk?->nama_barang ?? 'Produk' }}
                </div>
                <div class="receipt-item-qty">x{{ $item->kuantitas ?? $item->qty }}</div>
                <div class="receipt-item-total">Rp {{ number_format($item->subtotal) }}</div>
            </div>
            @endforeach

            <hr class="receipt-dashed">

            <div class="receipt-total-row">
                <span>TOTAL BAYAR</span>
                <span>Rp {{ number_format($sale->total_pembayaran) }}</span>
            </div>

            {{-- Tampilkan Uang Masuk & Kembalian khusus untuk transaksi Cash --}}
            @if ($sale->metode_pembayaran === 'CASH')
            <hr class="receipt-dashed">
            <div class="receipt-summary-row">
                <span>Uang Masuk</span>
                <span>Rp {{ number_format($sale->uang_masuk) }}</span>
            </div>
            <div class="receipt-summary-row">
                <span>Kembalian</span>
                <span>Rp {{ number_format($sale->kembalian) }}</span>
            </div>
            @endif

            <hr class="receipt-dashed">
            <div class="receipt-thanks">Terima kasih telah berbelanja</div>

        </div>
    </div>
</div>
@endsection