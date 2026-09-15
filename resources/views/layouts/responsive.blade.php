<style>
/* ==========================================================================
   RESPONSIVE.BLADE.PHP
   File CSS global untuk membuat seluruh aplikasi Kedai Mercon responsif
   di HP dan tablet. File ini di-include otomatis lewat layouts/app.blade.php
   sehingga berlaku ke SEMUA halaman (dashboard, POS, login, tabel data, dll)
   tanpa perlu mengubah satu-satu file halaman.
   ========================================================================== */

/* ---------- 0. Dasar: cegah scroll horizontal tak sengaja ---------- */
html, body {
    max-width: 100%;
    overflow-x: hidden;
}

img {
    max-width: 100%;
    height: auto;
}

/* Menghilangkan scrollbar horizontal yang tidak perlu di area katalog produk
   POS (efek samping dari lebar kolom yang sedikit meluber di lebar tablet).
   Scroll yang dipakai memang cuma scroll vertikal (naik-turun). */
.pos-catalog-scroll {
    overflow-x: hidden !important;
}

/* ---------- Halaman Login ----------
   Mengganti trik lama (position:absolute + translate-middle) yang cuma
   center dengan aman kalau tinggi kontennya pas, dengan flexbox yang
   selalu center sempurna secara horizontal MAUPUN vertikal di semua
   ukuran layar (desktop, tablet, HP) tanpa risiko terpotong. */
.halaman-login-khusus {
    min-height: calc(100vh - 40px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 12px;
    box-sizing: border-box;
}

.halaman-login-khusus .card.position-absolute {
    position: static !important;
    top: auto !important;
    left: auto !important;
    transform: none !important;
    margin: 0 !important;
    width: 100% !important;
}

/* ---------- 1. Form Create/Edit (Jenis, Produk, Users) ----------
   Pola lama pakai position:absolute + translate-middle-x yang bisa tidak
   center dengan benar di layar kecil. Di HP/tablet kita kembalikan ke
   posisi normal (static) supaya aman dan tetap center secara horizontal.
   (Halaman Login sudah punya aturan sendiri di atas, tidak perlu di sini lagi) */
@media (max-width: 767.98px) {
    .position-absolute.start-50.translate-middle-x {
        position: static !important;
        top: auto !important;
        left: auto !important;
        transform: none !important;
        max-width: 100% !important;
        width: 100% !important;
        margin: 16px auto !important;
        padding: 0 12px !important;
    }

    .position-relative.w-100[style*="min-height: 80vh"] {
        min-height: auto !important;
        padding-top: 16px !important;
        padding-bottom: 24px !important;
    }
}

/* ---------- 2. Baris Search + Tombol Tambah (Jenis, Produk, Penjualan, Users) ---------- */
@media (max-width: 767.98px) {
    .table-filter-action {
        display: flex !important;
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 10px !important;
    }

    .search-wrapper {
        max-width: 100% !important;
        width: 100% !important;
    }

    .btn-create-user {
        width: 100% !important;
        text-align: center !important;
        white-space: nowrap;
    }
}

/* ---------- 3. Tabel Data (custom-table & tabel Bootstrap biasa) ----------
   .table-responsive sudah ada di HTML, di sini kita cuma rapikan ukuran
   supaya tidak terlalu lebar dan enak di-scroll horizontal di HP. */
@media (max-width: 767.98px) {
    table.custom-table th,
    table.custom-table td,
    .table thead th,
    .table tbody td,
    .table tbody th {
        padding: 10px 12px !important;
        font-size: 13px !important;
        white-space: nowrap;
    }

    .container.mt-4,
    .container.py-4 {
        padding-left: 12px !important;
        padding-right: 12px !important;
    }
}

/* ---------- 4. Kartu Ringkasan Dashboard ----------
   Menghapus tinggi tetap (height: 90px) yang bisa bikin angka/tulisan
   terpotong kalau layar sempit membuat teks turun baris. */
@media (max-width: 576px) {
    .dashboard-page-wrapper .row .card {
        height: auto !important;
        min-height: 74px !important;
    }

    .dashboard-page-wrapper .row .card .card-body {
        height: auto !important;
        min-height: 46px !important;
        padding: 8px 10px !important;
    }

    .dashboard-page-wrapper h5.card-title {
        font-size: 16px !important;
        word-break: break-word;
    }

    .dashboard-page-wrapper h1 {
        font-size: 20px !important;
    }
}

/* ---------- 5. Halaman POS / Kasir (pos.blade.php) ----------
   Ini bagian paling penting: katalog produk & keranjang belanja perlu
   ditata ulang supaya nyaman dipakai kasir dari HP atau tablet. */
@media (max-width: 767.98px) {
    .pos-container {
        padding: 12px !important;
    }

    .pos-card-header h4 {
        font-size: 15px !important;
    }

    /* Batasi tinggi area scroll supaya tidak terlalu memanjang di HP */
    .pos-catalog-scroll {
        max-height: 320px !important;
    }

    .col-md-6 .table-responsive {
        max-height: 280px !important;
    }

    /* Baris tiap produk (foto+nama | qty | tombol +) di-tata ulang:
       nama produk full width di baris atas, qty & tombol + di baris bawah
       supaya tidak berdesakan di layar sempit */
    .pos-catalog-scroll form.row {
        flex-wrap: wrap;
        row-gap: 6px;
    }

    .pos-catalog-scroll .col-7 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }

    .pos-catalog-scroll .col-3 {
        flex: 0 0 72% !important;
        max-width: 72% !important;
    }

    .pos-catalog-scroll .col-2 {
        flex: 0 0 25% !important;
        max-width: 25% !important;
    }

    .card-footer strong {
        font-size: 22px !important;
    }
}

/* ---------- 6. Form Produk: baris Upload Foto + Preview Foto ----------
   Tanpa breakpoint, dua kolom ini selalu berdampingan dan bisa terlalu
   sempit di HP. Kita tumpuk vertikal di layar kecil. */
@media (max-width: 480px) {
    .card-body .row.mb-3 > .col {
        flex: 0 0 100% !important;
        max-width: 100% !important;
        margin-bottom: 14px;
    }

    .card-body .row.mb-3 > .col:last-child {
        margin-bottom: 0;
    }
}

/* ---------- 7. Halaman Tentang: rapikan padding kartu di HP kecil ---------- */
@media (max-width: 400px) {
    .card .card-body {
        padding: 16px !important;
    }
}

/* ---------- 8. Struk / Invoice: pastikan tetap muat penuh di layar sempit ---------- */
@media (max-width: 400px) {
    .receipt-paper {
        padding: 24px 16px 18px !important;
    }
}
</style>