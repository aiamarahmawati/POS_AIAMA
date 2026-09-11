@extends('layouts.app')

@section('title', 'POS')

@section('content')
<style>
    /* ==========================================================================
   HALAMAN TRANSAKSI UTAMA POS / KASIR
   ========================================================================== */

/* 1. Mengubah Judul Halaman Atas */

h4.mb-3 {
    font-size: 20px !important;
    font-weight: 700 !important;
    color: #1E293B !important;
    /* Slate Dark pekat */
    margin-bottom: 20px !important;
}

/* 2. Merapikan Kotak Pencarian Produk */

.card-body input[placeholder="Cari produk..."] {
    border-radius: 8px !important;
    border: 1px solid #E2E8F0 !important;
    padding: 10px 14px !important;
}

/* 3. Menyulap Kotak Katalog Produk di Sebelah Kiri */

.card-body .btn-outline-primary {
    background-color: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    /* Mengubah garis luar biru pekat jadi abu-abu halus */
    border-radius: 10px !important;
    color: #1E293B !important;
    /* Teks nama produk menjadi Slate Dark */
    transition: all 0.2s ease !important;
}

.card-body .btn-outline-primary:hover {
    background-color: #F8FAFC !important;
    /* Berubah abu-abu sangat muda saat disentuh */
    border-color: #CBD5E1 !important;
}

.card-body .btn-outline-primary .text-muted {
    color: #64748B !important;
    /* Warna harga barang dibuat lebih tenang */
    font-size: 13px !important;
}

/* 4. Mengubah Tombol "+" Biru Besar */

.card-body .btn-primary {
    background-color: #0EA5E9 !important;
    /* Menggunakan Ocean Blue (Aksen 10% kita) */
    border: 1px solid #0EA5E9 !important;
    font-weight: 700 !important;
    border-radius: 8px !important;
}

.card-body .btn-primary:hover {
    background-color: #0284C7 !important;
}

/* 5. Merapikan Area Tabel Keranjang Belanja Sebelah Kanan */

.card table.table-bordered {
    border-collapse: collapse !important;
    border: none !important;
}

.card table.table-bordered th {
    background-color: #F8FAFC !important;
    color: #64748B !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    border-bottom: 2px solid #E2E8F0 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
}

.card table.table-bordered td {
    color: #334155 !important;
    font-size: 14px !important;
    border-bottom: 1px solid #F1F5F9 !important;
    border-top: none !important;
    border-left: none !important;
    border-right: none !important;
    vertical-align: middle !important;
}

/* Kotak Input Qty Kecil di dalam tabel keranjang */

.card table.table-bordered td input.form-control-sm {
    border: 1px solid #E2E8F0 !important;
    border-radius: 6px !important;
    text-align: center !important;
    max-width: 70px !important;
}

/* Tombol Hapus Merah Kecil di dalam tabel keranjang */

.card table.table-bordered td .btn-danger {
    background-color: transparent !important;
    border: 1px solid #FCA5A5 !important;
    /* Outline merah lembut */
    color: #EF4444 !important;
    font-weight: 600 !important;
    border-radius: 6px !important;
    padding: 4px 10px !important;
    font-size: 12px !important;
    transition: all 0.15s ease !important;
}

.card table.table-bordered td .btn-danger:hover {
    background-color: #FEF2F2 !important;
    border-color: #EF4444 !important;
    color: #DC2626 !important;
}

/* 6. Menyulap Bagian Footer (Total Harga, Dropdown & Checkout) */

.card-footer {
    background-color: #FFFFFF !important;
    /* Mengubah footer abu-abu kasar jadi putih bersih */
    border-top: 1px solid #E2E8F0 !important;
    padding: 20px !important;
}

/* Tulisan Total Harga Utama (Misal: Rp 7,000) */

.card-footer strong {
    font-size: 26px !important;
    /* Dibuat besar dan sangat tegas */
    font-weight: 800 !important;
    color: #1E293B !important;
    /* Slate Dark pekat */
    display: block !important;
    margin-bottom: 16px !important;
    letter-spacing: -0.5px !important;
}

/* Dropdown Pilih Pembayaran */

.card-footer select.form-select {
    border: 1px solid #E2E8F0 !important;
    border-radius: 8px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1E293B !important;
    margin-bottom: 12px !important;
}

/* TOMBOL UTAMA TRANSAKSI: Tombol Checkout (Hijau Premium) */

.card-footer .btn-success {
    background-color: #10B981 !important;
    /* Emerald Green modern */
    border: 1px solid #10B981 !important;
    color: #FFFFFF !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    padding: 12px 24px !important;
    border-radius: 8px !important;
    box-shadow: 0 1px 2px 0 rgba(16, 185, 129, 0.2) !important;
    transition: background-color 0.2s ease !important;
    cursor: pointer;
}

.card-footer .btn-success:hover {
    background-color: #059669 !important;
    /* Hijau lebih dalam saat di-hover */
}

/* TOMBOL SEKUNDER: Tombol Batal Transaksi (Minimalis Halus) */

.card-footer .btn-outline-danger {
    background-color: transparent !important;
    border: 1px solid #E2E8F0 !important;
    /* Diubah menjadi outline netral halus agar tidak mengganggu mata kasir */
    color: #64748B !important;
    /* Warna teks abu-abu sekunder */
    font-weight: 600 !important;
    font-size: 14px !important;
    padding: 10px 24px !important;
    border-radius: 8px !important;
    transition: all 0.15s ease !important;
}

.card-footer .btn-outline-danger:hover {
    background-color: #FEF2F2 !important;
    /* Berubah menjadi merah lembut hanya saat di-hover */
    border-color: #FCA5A5 !important;
    color: #EF4444 !important;
}

/* ==========================================================================
   KODE PELENGKAP UNTUK MEMBUAT KOTAK CARD PUTIH BERSIH MINIMALIS
   ========================================================================== */
/* Membungkus halaman kasir agar rapi, berada di tengah, dan memiliki jarak ideal */

.pos-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 24px;
}

/* Kotak Card Utama (Meniru persis gaya kotak putih bertingkat pada Tambah Produk) */

.pos-card-main {
    background-color: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    /* Garis tepi abu-abu sangat tipis */
    border-radius: 12px !important;
    /* Sudut melengkung halus */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
    /* Shadow halus premium */
    overflow: hidden;
}

/* Kepala Kotak untuk Judul Halaman "TAMBAH PENJUALAN BARU" */

.pos-card-header {
    background-color: #FFFFFF !important;
    border-bottom: 1px solid #F1F5F9 !important;
    padding: 20px 24px !important;
}

.pos-card-header h4 {
    font-size: 16px !important;
    font-weight: 700 !important;
    color: #1E293B !important;
    text-transform: uppercase;
    /* Membuat teks otomatis huruf besar semua */
    letter-spacing: 0.5px;
    margin: 0 !important;
}

/* Membatasi tinggi katalog produk di kiri agar sejajar & rapi dengan keranjang di kanan */

.pos-catalog-scroll {
    max-height: 490px;
    overflow-y: auto;
    /* Memunculkan scrollbar hanya jika produk penuh */
    padding-right: 8px;
}

/* Mengubah tampilan scrollbar katalog produk agar tipis dan minimalis */

.pos-catalog-scroll::-webkit-scrollbar {
    width: 6px;
}

.pos-catalog-scroll::-webkit-scrollbar-track {
    background: #F1F5F9;
    border-radius: 4px;
}

.pos-catalog-scroll::-webkit-scrollbar-thumb {
    background: #CBD5E1;
    border-radius: 4px;
}

/* Membatasi tinggi tabel keranjang belanja agar sejajar seimbang dengan katalog kiri */

.col-md-6 .table-responsive {
    max-height: 430px;
    overflow-y: auto;
    /* Memunculkan scrollbar vertikal hanya jika item belanjaan penuh */
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    padding-right: 4px;
}

/* Mengubah tampilan scrollbar keranjang belanja agar tipis halus */

.col-md-6 .table-responsive::-webkit-scrollbar {
    width: 6px;
}

.col-md-6 .table-responsive::-webkit-scrollbar-track {
    background: #F1F5F9;
    border-radius: 4px;
}

.col-md-6 .table-responsive::-webkit-scrollbar-thumb {
    background: #CBD5E1;
    border-radius: 4px;
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
{{-- 1. Menampilkan error validasi bawaan Laravel dengan aman --}}
<div id="server-alert-container">
    @if (isset($errors) && is_object($errors) && $errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @elseif(is_string($errors) && !empty($errors))
        {{-- Jika variabel $errors terlanjur menjadi string akibat session lama yang tersangkut --}}
        <div class="alert alert-danger">
            {{ $errors }}
        </div>
    @endif

    {{-- 2. Menampilkan error kustom baru Anda dari session flash --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>

{{-- 3. Wadah kosong untuk error dari JavaScript (validasi checkout Cash/QRIS) --}}
<div id="js-alert-container"></div>

{{-- Modal konfirmasi kustom bertema POS (pengganti confirm() bawaan browser) --}}
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


    <!-- 2. KOTAK CARD UTAMA: Membuat wadah putih bertingkat dengan bayangan halus -->
    <div class="pos-card-main">
        
        <!-- 3. KEPALA KOTAK BARU: Menyulap judul halaman masuk ke baris atas kardus yang rapi -->
        <div class="pos-card-header">
            <h4>{{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}</h4>
        </div>

        <!-- ISI TRANSAKSI KASIR -->
        <div class="card-body">
            <div class="row">
                
                {{-- ================= PRODUK (SISI KIRI) ================= --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Cari produk..."
                                   onkeyup="this.form.submit()">
                        </form>
                    </div>
                    
                    <!-- 4. PEMBATAS SCROLLBAR: Membaca kelas baru Anda untuk membatasi tinggi katalog produk -->
                    <div class="pos-catalog-scroll">
                        @foreach($products as $product)
                            <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="col-7">
                                    <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                        <div class="d-flex align-items-center gap-2">

                                            {{-- Gambar produk --}}
                                            <img src="{{ asset('storage/'.$product->foto) }}" 
                                                alt="Gambar"
                                                class="rounded-circle"
                                                style="width:45px; height:45px; object-fit:cover;">

                                            {{-- Nama & harga --}}
                                            <div>
                                                <div class="fw-semibold">{{ $product->nama }}</div>
                                                <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div class="col-3">
                                    <input type="number" name="quantity" value="1" min="1"
                                            class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                                </div>

                                <div class="col-2">
                                    <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                        +</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>

                {{-- ================= KERANJANG (SISI KANAN) ================= --}}
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->itemPenjualan as $item)
                                <tr>
                                    <td>{{ $item->produk->nama }}</td>
                                    <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number" name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   class="form-control form-control-sm">
                                        </form>
                                    </td>
                                    <td>Rp {{ number_format($item->subtotal) }}</td>
                                    <td>
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Keranjang kosong
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- 5. AREA FOOTER: Total pembayaran, metode bayar, dan tombol aksi -->
                    <div class="card-footer mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted fw-bold" style="font-size: 14px;">TOTAL HARGA:</span>
                            <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>
                        </div>

                        <form method="POST" 
                                action="{{ route('penjualan.update', $sale->id) }}" 
                                id="form-checkout" class="mt-2">
                            @csrf
                            @method('PUT')
                            <select name="payment_method" id="payment_method" class="form-select mb-2">
                                <option value="">Pilih Pembayaran</option>
                                <option value="CASH">Cash</option>
                                <option value="QRIS">QRIS</option>
                            </select>

                            {{-- Area dinamis: muncul input Uang Masuk & Kembalian jika Cash, atau QR jika QRIS --}}
                            <div id="area-pembayaran" class="mb-2"></div>

                            <button class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Checkout
                            </button>
                        </form>
                        
                        @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}" 
                              method="POST"
                              data-confirm="Yakin ingin membatalkan transaksi ini?"
                              data-confirm-danger="true"
                              data-confirm-ok-text="Ya, Batalkan">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Batal Transaksi
                              </button>
                        </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>

    </div> <!-- Akhir dari pos-card-main -->

</div> <!-- Akhir dari pos-container -->

{{-- ============================================================
     TAMBAHAN: Script untuk fitur Cash (uang masuk & kembalian)
     dan QRIS (tampilkan QR code) saat memilih metode pembayaran
     ============================================================ --}}
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
    const totalHargaPOS = {{ $sale->total_pembayaran }};
    const cartIsEmptyPOS = {{ $sale->itemPenjualan->count() === 0 ? 'true' : 'false' }};

    document.getElementById('payment_method').addEventListener('change', function () {
        const area = document.getElementById('area-pembayaran');
        const metode = this.value;

        if (metode === 'CASH') {
            area.innerHTML = `
                <label class="form-label">Uang Masuk</label>
                <input type="number" name="uang_masuk" id="uang_masuk"
                       class="form-control mb-1" placeholder="Masukkan nominal uang">
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="text-muted">Kembalian:</span>
                    <strong id="kembalian-text">Rp 0</strong>
                </div>
            `;

            document.getElementById('uang_masuk').addEventListener('input', function () {
                const bayar = parseInt(this.value) || 0;
                const kembalian = bayar - totalHargaPOS;
                document.getElementById('kembalian-text').innerText =
                    'Rp ' + (kembalian > 0 ? kembalian.toLocaleString('id-ID') : 0);
                clearJsError();
            });

        } else if (metode === 'QRIS') {
            area.innerHTML = `
                <div class="text-center border rounded p-3">
                    <p class="mb-2 text-muted" style="font-size:13px;">
                        Scan untuk membayar Rp ${totalHargaPOS.toLocaleString('id-ID')}
                    </p>
                    <div id="qr-canvas-wrapper" class="d-flex justify-content-center"></div>
                </div>
            `;
            generateQRISPOS(totalHargaPOS, {{ $sale->id }});
        } else {
            area.innerHTML = '';
        }
    });

    function generateQRISPOS(total, saleId) {
        const wrapper = document.getElementById('qr-canvas-wrapper');
        const canvas = document.createElement('canvas');
        QRCode.toCanvas(canvas, `SALE:${saleId}|TOTAL:${total}`, { width: 180 }, function (error) {
            if (error) {
                console.error(error);
                wrapper.innerHTML = '<span class="text-danger">Gagal membuat QR code</span>';
                return;
            }
            wrapper.appendChild(canvas);
        });
    }

    document.getElementById('form-checkout').addEventListener('submit', function (e) {
        const form = this;

        // Jika sudah dikonfirmasi lewat modal kustom, biarkan form submit seperti biasa
        if (form.dataset.confirmed === 'true') {
            return;
        }

        if (cartIsEmptyPOS) {
            showJsError('Keranjang masih kosong');
            e.preventDefault();
            return;
        }

        const metode = document.getElementById('payment_method').value;

        if (!metode) {
            showJsError('Silakan pilih metode pembayaran terlebih dahulu');
            e.preventDefault();
            return;
        }

        if (metode === 'CASH') {
            const bayarInput = document.getElementById('uang_masuk');
            const bayar = parseInt(bayarInput.value) || 0;
            if (bayar < totalHargaPOS) {
                showJsError('Uang masuk kurang dari total harga');
                e.preventDefault();
                return;
            }
        }

        clearJsError();

        // Tahan submit, tampilkan modal konfirmasi kustom bertema POS
        e.preventDefault();
        showCustomConfirm('Apakah Anda yakin ingin checkout?', function () {
            form.dataset.confirmed = 'true';
            form.submit();
        });
    });

    // Menampilkan kotak error merah dengan gaya sama seperti error dari server (session('error')).
    // Juga menghapus kotak error lama dari server, supaya tidak numpuk dua kotak sekaligus.
    function showJsError(message) {
        const serverContainer = document.getElementById('server-alert-container');
        if (serverContainer) serverContainer.innerHTML = '';

        const container = document.getElementById('js-alert-container');
        container.innerHTML = `<div class="alert alert-danger">${message}</div>`;
        container.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Menghapus kotak error JS, dipanggil saat user mulai memperbaiki input
    function clearJsError() {
        document.getElementById('js-alert-container').innerHTML = '';
    }

    // Bersihkan pesan error otomatis saat user mengganti metode pembayaran atau mengetik ulang uang masuk
    document.getElementById('payment_method').addEventListener('change', clearJsError);
</script>

{{-- ============================================================
     MODAL KONFIRMASI KUSTOM: pengganti confirm() bawaan browser
     Bisa dipakai otomatis oleh form manapun yang punya atribut
     data-confirm="pesan konfirmasi" (contoh: tombol Batal Transaksi)
     ============================================================ --}}
<script>
(function () {
    const overlay = document.getElementById('customConfirmOverlay');
    const msgEl = document.getElementById('customConfirmMessage');
    const okBtn = document.getElementById('customConfirmOkBtn');
    const cancelBtn = document.getElementById('customConfirmCancelBtn');
    const iconEl = document.getElementById('customConfirmIcon');
    let pendingCallback = null;

    // Fungsi global, bisa dipanggil dari script manapun di halaman ini
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

    // Menangani otomatis semua <form data-confirm="..."> di halaman ini
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