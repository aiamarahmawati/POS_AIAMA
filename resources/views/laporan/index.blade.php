@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@include('layouts.navbar')

@section('content')

<style>
        .container h1,
        .pos-container h1,
        .table-filter-action~h1,
        h1 {
            font-size: 24px !important;
            font-weight: 700 !important;
            color: #1E293B !important;
            letter-spacing: -0.5px !important;
            margin-top: 15px !important;
            margin-bottom: 20px !important;
            text-align: left !important;
        }

        h2.section-title {
            font-size: 15px;
            font-weight: 700;
            color: #1E293B;
            margin: 32px 0 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid #E2E8F0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ---------- Form Filter Tanggal ---------- */

        .filter-box {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02);
            padding: 20px;
            margin-bottom: 24px;
        }

        .filter-box label {
            font-size: 12px !important;
            font-weight: 600 !important;
            color: #64748B !important;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px !important;
            display: block;
        }

        .filter-box .form-control {
            border: 1px solid #E2E8F0 !important;
            border-radius: 8px !important;
            padding: 8px 14px !important;
            font-size: 14px !important;
            color: #1E293B !important;
            background-color: #FFFFFF;
        }

        .filter-box .form-control:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1) !important;
            outline: none;
        }

        .btn-tampilkan {
            background-color: #0EA5E9 !important;
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 8px 20px !important;
            border: none !important;
            border-radius: 8px !important;
            width: 100%;
            transition: background-color 0.2s ease;
        }

        .btn-tampilkan:hover {
            background-color: #0284C7 !important;
        }

        /* ---------- Card Ringkasan ---------- */

        .summary-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02);
            overflow: hidden;
        }

        .summary-card .summary-header {
            background-color: #F8FAFC;
            border-bottom: 1px solid #E2E8F0;
            font-size: 11px;
            font-weight: 700;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 16px;
        }

        .summary-card .summary-body {
            padding: 16px;
        }

        .summary-card .summary-value {
            font-size: 22px;
            font-weight: 700;
            color: #1E293B;
            margin: 0;
        }

        /* ---------- Tabel (sama seperti Produk & Paket) ---------- */

        table.custom-table {
            width: 100% !important;
            background-color: #FFFFFF !important;
            border: 1px solid #E2E8F0 !important;
            border-radius: 12px !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            overflow: hidden !important;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02) !important;
            margin-top: 4px !important;
        }

        table.custom-table tr:first-child th:first-child {
            border-top-left-radius: 12px;
        }

        table.custom-table tr:first-child th:last-child {
            border-top-right-radius: 12px;
        }

        table.custom-table tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        table.custom-table tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        table.custom-table th {
            background-color: #F8FAFC !important;
            color: #64748B !important;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px !important;
            border-bottom: 2px solid #E2E8F0 !important;
            text-align: left;
        }

        table.custom-table td {
            padding: 14px 16px !important;
            color: #334155 !important;
            font-size: 14px;
            border-bottom: 1px solid #F1F5F9 !important;
            text-align: left;
            vertical-align: middle;
        }

        table.custom-table tbody tr:hover {
            background-color: #F8FAFC !important;
        }

        /* ---------- Badge Status ---------- */

        .badge-selesai {
            display: inline-block;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            background-color: #F0FDF4;
            color: #16A34A;
        }

        .badge-tertunda {
            display: inline-block;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            background-color: #FEF9C3;
            color: #A16207;
        }
</style>

<div class="container mt-4">

    <h1 class="mb-4">Laporan Penjualan</h1>

    {{-- Form Filter Tanggal --}}
    <div class="filter-box">
        <form method="GET" action="{{ route('laporan.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control"
                           value="{{ $tanggalMulai->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control"
                           value="{{ $tanggalAkhir->format('Y-m-d') }}"
                           max="{{ now()->format('Y-m-d') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-tampilkan">Tampilkan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Ringkasan --}}
    <div class="row g-3 mb-2">
        <div class="col-md-6">
            <div class="summary-card">
                <div class="summary-header">Total Penjualan (Selesai)</div>
                <div class="summary-body">
                    <p class="summary-value">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="summary-card">
                <div class="summary-header">Jumlah Transaksi</div>
                <div class="summary-body">
                    <p class="summary-value">{{ $jumlahTransaksi }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Detail Transaksi --}}
    <h2 class="section-title">Detail Transaksi</h2>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kasir</th>
                    <th>Total Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penjualan as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td class="fw-semibold">Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ strtoupper($item->metode_pembayaran) }}</td>
                        <td>
                            @if ($item->status === 'COMPLETED')
                                <span class="badge-selesai">Selesai</span>
                            @else
                                <span class="badge-tertunda">Tertunda</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            Tidak ada data pada rentang tanggal ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection