@csrf
<style>
div.card.bg-white {
    background-color: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    border-radius: 12px !important;
    /* Kelengkungan sudut disamakan dengan tabel */
    box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02) !important;
}

div.card-header {
    background-color: #F8FAFC !important;
    /* Warna header abu-abu premium */
    border-bottom: 1px solid #E2E8F0 !important;
    padding: 16px 20px !important;
}


/* Judul "Tambah User Baru" */

div.card-header h1 {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #1E293B !important;
    /* Slate Dark */
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0 !important;
}


/* Label Input (Nama, Email, dll) */

.form-label {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #475569 !important;
    /* Muted Slate */
    margin-bottom: 6px !important;
}


/* Kolom Isian Input & Dropdown Select */

.form-control,
.form-select {
    border: 1px solid #E2E8F0 !important;
    /* Border abu-abu tipis modern */
    border-radius: 8px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1E293B !important;
    background-color: #FFFFFF !important;
    box-shadow: none !important;
    transition: all 0.2s ease !important;
}


/* Efek Fokus Menyala Lembut Khas SaaS Modern */

.form-control:focus,
.form-select:focus {
    border-color: #0EA5E9 !important;
    /* Ocean Blue */
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12) !important;
}


/* Container Pembungkus Tombol Aksi */

.form-actions {
    margin-top: 32px;
    display: flex;
    gap: 12px;
}


/* Tombol Simpan (Primary Action) */

.btn-submit {
    background: #0EA5E9 !important;
    /* Ocean Blue */
    border: 1px solid #0EA5E9 !important;
    color: #FFFFFF !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    padding: 10px 24px !important;
    border-radius: 8px !important;
    box-shadow: 0 1px 2px 0 rgba(14, 165, 233, 0.15) !important;
    transition: background-color 0.2s ease !important;
    cursor: pointer;
}

.btn-submit:hover {
    background: #0284C7 !important;
    border-color: #0284C7 !important;
}


/* Tombol Kembali / Batal (Secondary Action) */

.btn-cancel {
    background: transparent !important;
    border: 1px solid #E2E8F0 !important;
    color: #475569 !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    padding: 10px 24px !important;
    border-radius: 8px !important;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    transition: all 0.15s ease !important;
}

.btn-cancel:hover {
    background: #F8FAFC !important;
    border-color: #CBD5E1 !important;
    color: #1E293B !important;
}
</style>
<div class="mb-3">
    <!-- Memanggil class .form-label dari CSS Anda -->
    <label class="form-label">Nama Jenis</label>
    
    <!-- Memanggil class .form-control dari CSS Anda -->
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $jenis->nama ?? '') }}" required  autocomplete="off">
    
    @error('nama')
        <!-- Memanggil class invalid-feedback bawaan untuk pesan eror minimalis -->
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<!-- CONTAINER TOMBOL AKSI: Memanggil class .form-actions dari CSS Anda agar berjejer rapi menyamping -->
<div class="form-actions">
    
    <!-- Tombol Simpan: Memanggil class .btn-submit dari CSS Anda -->
    <button type="submit" class="btn-submit">
        Simpan
    </button>
    
    <!-- Tombol Kembali: Memanggil class .btn-cancel dari CSS Anda -->
    <a href="{{ route('jenis.index') }}" class="btn-cancel">
        Kembali
    </a>
    
</div>
