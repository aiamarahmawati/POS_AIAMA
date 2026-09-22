@extends('layouts.app')

@section('title', 'Penjualan')

@include('layouts.navbar')

@section('content')

    <style>
        /* ==========================================================================
       STYLING SERAGAM UNTUK SEMUA JUDUL HALAMAN UTAMA (USERS, PRODUK, PENJUALAN)
       ========================================================================== */


        /* Menargetkan tag h1 yang menjadi judul utama di setiap halaman */

        .container h1,
        .pos-container h1,
        .table-filter-action~h1,
        h1 {
            font-size: 24px !important;
            /* Ukuran huruf proporsional dan tegas */
            font-weight: 700 !important;
            /* Ketebalan huruf tebal pekat */
            color: #1E293B !important;
            /* Menggunakan Slate Dark (senada dengan POS) */
            letter-spacing: -0.5px !important;
            /* Jarak antar huruf sedikit rapat agar modern */
            margin-top: 15px !important;
            /* Jarak ideal dari navbar atas */
            margin-bottom: 20px !important;
            /* Jarak ideal sebelum tombol atau filter cari */
            text-align: left !important;
            /* Mengunci posisi rata kiri yang rapi */
        }


        /* ==========================================================================
       HALAMAN MANAGEMENT DATA (USERS & MASTER DATA) - FINAL PERFECTED
       ========================================================================== */


        /* ---------- 1. Tata Letak Filter & Tombol Create ---------- */

        .table-filter-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
        }


        /* Kotak Pembungkus Search */

        .search-wrapper {
            display: flex;
            max-width: 400px;
            width: 100%;
        }

        .search-input {
            flex: 1;
            border: 1px solid #E2E8F0 !important;
            border-radius: 8px 0 0 8px !important;
            padding: 8px 14px !important;
            font-size: 14px !important;
            color: #1E293B !important;
            background-color: #FFFFFF;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: #0EA5E9 !important;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1) !important;
            outline: none;
        }

        .search-btn {
            border: 1px solid #E2E8F0 !important;
            border-left: none !important;
            background-color: #F8FAFC !important;
            color: #64748B !important;
            padding: 0 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 0 8px 8px 0 !important;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .search-btn:hover {
            background-color: #F1F5F9 !important;
            color: #1E293B !important;
        }


        /* ---------- 2. Tombol Create Utama (Aksen Biru Modern) ---------- */

        .btn-create-user {
            background-color: #0EA5E9 !important;
            color: #FFFFFF !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            padding: 10px 20px !important;
            border-radius: 8px !important;
            text-decoration: none !important;
            display: inline-block;
            box-shadow: 0 1px 2px 0 rgba(14, 165, 233, 0.2) !important;
            transition: background-color 0.2s ease;
        }

        .btn-create-user:hover {
            background-color: #0284C7 !important;
        }


        /* ---------- 3. Pengunci Tabel Putih Bersih & Membulat ---------- */

        table.custom-table {
            width: 100% !important;
            background-color: #FFFFFF !important;
            /* Memaksa background tabel jadi putih solid */
            border: 1px solid #E2E8F0 !important;
            border-radius: 12px !important;
            border-collapse: separate !important;
            /* Wajib separate agar lengkungan sudut luar terlihat */
            border-spacing: 0 !important;
            overflow: hidden !important;
            box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02) !important;
            margin-top: 20px !important;
        }


        /* Merapikan sudut-sudut lengkung tabel */

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


        /* ---------- 4. Badge Status Role Kotak Lembut Premium ---------- */

        span.badge-role {
            display: inline-block !important;
            padding: 6px 12px !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            text-transform: capitalize !important;
        }


        /* Warna spesifik jika class-nya 'admin' */

        span.badge-role.admin {
            background-color: #EFF6FF !important;
            color: #2563EB !important;
        }


        /* Warna spesifik jika class-nya 'kasir' */

        span.badge-role.kasir {
            background-color: #F0FDF4 !important;
            color: #16A34A !important;
        }


        /* ---------- 5. Tombol Aksi Minimalis (Sederhana & Elegan) ---------- */

        .btn-action-edit {
            background: transparent !important;
            border: 1px solid #E2E8F0 !important;
            color: #475569 !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            text-decoration: none !important;
            transition: all 0.15s ease;
        }

        .btn-action-edit:hover {
            background: #F8FAFC !important;
            border-color: #CBD5E1 !important;
            color: #1E293B !important;
        }

        .btn-action-delete {
            background: transparent !important;
            border: 1px solid #E2E8F0 !important;
            color: #EF4444 !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
            transition: all 0.15s ease;
        }

        .btn-action-delete:hover {
            background: #FEF2F2 !important;
            border-color: #FCA5A5 !important;
            color: #DC2626 !important;
        }

        /* Menangkap tombol edit kuning bawaan bootstrap di tabel produk & penjualan lalu mengubahnya menjadi outline modern */

        .custom-table .btn-warning,
        table.custom-table td .btn-warning {
            background: transparent !important;
            border: 1px solid #E2E8F0 !important;
            color: #475569 !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            padding: 4px 10px !important;
            border-radius: 6px !important;
            box-shadow: none !important;
            text-decoration: none !important;
            display: inline-block !important;
            transition: all 0.15s ease !important;
        }

        .custom-table .btn-warning:hover,
        table.custom-table td .btn-warning:hover {
            background: #F8FAFC !important;
            border-color: #CBD5E1 !important;
            color: #1E293B !important;
        }

        /* ==========================================================================
       MODAL KONFIRMASI KUSTOM (pengganti popup bawaan browser confirm())
       ========================================================================== */

        .custom-confirm-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .custom-confirm-overlay.show {
            display: flex;
        }

        .custom-confirm-box {
            background: #FFFFFF;
            border-radius: 14px;
            max-width: 360px;
            width: 100%;
            padding: 24px;
            box-shadow: 0 20px 40px -8px rgba(15, 23, 42, 0.25);
            text-align: center;
            animation: customConfirmPop 0.15s ease;
        }

        @keyframes customConfirmPop {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .custom-confirm-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #EFF6FF;
            color: #0EA5E9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 22px;
            font-weight: 700;
        }

        .custom-confirm-icon.danger {
            background: #FEF2F2;
            color: #EF4444;
        }

        .custom-confirm-message {
            font-size: 15px;
            font-weight: 600;
            color: #1E293B;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .custom-confirm-actions {
            display: flex;
            gap: 10px;
        }

        .custom-confirm-btn {
            flex: 1;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .custom-confirm-btn-cancel {
            background: #F1F5F9;
            color: #475569;
        }

        .custom-confirm-btn-cancel:hover {
            background: #E2E8F0;
        }

        .custom-confirm-btn-ok {
            background: #0EA5E9;
            color: #FFFFFF;
        }

        .custom-confirm-btn-ok:hover {
            background: #0284C7;
        }

        .custom-confirm-btn-ok.danger {
            background: #EF4444;
        }

        .custom-confirm-btn-ok.danger:hover {
            background: #DC2626;
        }
    </style>

    <div class="container mt-4">

        {{-- Modal konfirmasi kustom (pengganti confirm() bawaan browser) --}}
        <div class="custom-confirm-overlay" id="customConfirmOverlay">
            <div class="custom-confirm-box">
                <div class="custom-confirm-icon" id="customConfirmIcon">?</div>
                <div class="custom-confirm-message" id="customConfirmMessage">Apakah Anda yakin?</div>
                <div class="custom-confirm-actions">
                    <button type="button" class="custom-confirm-btn custom-confirm-btn-cancel" id="customConfirmCancelBtn">Batal</button>
                    <button type="button" class="custom-confirm-btn custom-confirm-btn-ok" id="customConfirmOkBtn">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>

        @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif

        <h1 class="mb-4">Penjualan</h1>

        <!-- 1. PEMBUNGKUS BARU: Menyelaraskan search dan tombol create agar sejajar kanan-kiri -->
        <div class="table-filter-action">
            <form action="{{ route('penjualan.index') }}" method="GET" class="search-wrapper">
                <input type="text" name="search" value="{{ request()->search }}" class="search-input"
                    placeholder="Cari nama kasir..." autocomplete="off">
                <button class="search-btn" type="submit">
                    Cari
                </button>
            </form>

            <a href="{{ route('penjualan.create') }}" class="btn-create-user">+ Tambah Penjualan</a>
        </div>

        <!-- 2. STRUKTUR TABEL BARU: Menggunakan class custom-table agar otomatis putih bersih -->
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
                        <th style="width: 250px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr>
                            <td>{{ $sales->firstItem() + $loop->index }}</td>
                            <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td class="fw-semibold">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</td>
                            <td>{{ $sale->metode_pembayaran }}</td>
                            <td>
                                <!-- 3. BADGE STATUS (10% AKSI): Memberikan warna dinamis pada status transaksi -->
                                @if ($sale->status == 'COMPLETED')
                                    <span class="badge-role kasir">Selesai</span>
                                @else
                                    <span class="badge-role"
                                        style="background-color: #FEF3C7 !important; color: #D97706 !important;">Tertunda</span>
                                @endif
                            </td>
                            <td>
                                <!-- 4. TOMBOL AKSI: Menggunakan kelas minimalis outline yang elegan tanpa simbol || -->
                                <div class="d-flex gap-2 justify-content-end align-items-center">
                                    <!-- Pastikan tombol detail Anda memanggil rute penjualan.show -->
                                    <a href="{{ route('penjualan.show', $sale->id) }}"
                                        class="btn btn-action-edit py-1 px-2 lh-sm"
                                        style="font-size: 13px !important;">Detail</a>

                                    @can('view', $sale)
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning">
                                            {{ $sale->status === 'OPEN' ? 'Lanjutkan' : 'Edit' }}
                                        </a>
                                    @endcan

                                    @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST"
                                            class="d-inline m-0 p-0"
                                            data-confirm="Apakah Anda yakin akan menghapus penjualan ini?"
                                            data-confirm-danger="true"
                                            data-confirm-ok-text="Ya, Hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-action-delete py-1 px-2 lh-sm"
                                                style="font-size: 13px !important;">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Data penjualan tidak tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $sales->links() }}
        </div>
    </div>


{{-- ============================================================
     Script untuk modal konfirmasi kustom di halaman ini
     ============================================================ --}}
<script>
(function () {
    const overlay = document.getElementById('customConfirmOverlay');
    const msgEl = document.getElementById('customConfirmMessage');
    const okBtn = document.getElementById('customConfirmOkBtn');
    const cancelBtn = document.getElementById('customConfirmCancelBtn');
    const iconEl = document.getElementById('customConfirmIcon');
    let pendingCallback = null;

    window.showCustomConfirm = function (message, onConfirm, opts) {
        opts = opts || {};
        msgEl.textContent = message;
        iconEl.textContent = opts.danger ? '!' : '?';
        iconEl.classList.toggle('danger', !!opts.danger);
        okBtn.classList.toggle('danger', !!opts.danger);
        okBtn.textContent = opts.okText || 'Ya, Lanjutkan';
        pendingCallback = onConfirm;
        overlay.classList.add('show');
    };

    function closeCustomConfirm() {
        overlay.classList.remove('show');
        pendingCallback = null;
    }

    okBtn.addEventListener('click', function () {
        const callback = pendingCallback;
        closeCustomConfirm();
        if (callback) callback();
    });

    cancelBtn.addEventListener('click', closeCustomConfirm);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeCustomConfirm();
    });

    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (form.dataset.confirmed === 'true') return;
            e.preventDefault();
            showCustomConfirm(form.dataset.confirm, function () {
                form.dataset.confirmed = 'true';
                form.submit();
            }, {
                danger: form.dataset.confirmDanger === 'true',
                okText: form.dataset.confirmOkText
            });
        });
    });
})();
</script>
@endsection