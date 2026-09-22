@csrf
<style>
    /* ==========================================================================
   HALAMAN FORM / TAMBAH DATA (SOPHISTICATED MODERN)
   ========================================================================== */

div.card.bg-white {
    background-color: #FFFFFF !important;
    border: 1px solid #E2E8F0 !important;
    border-radius: 12px !important;
    box-shadow: 0 1px 3px 0 rgba(15, 23, 42, 0.02) !important;
}

div.card-header {
    background-color: #F8FAFC !important;
    border-bottom: 1px solid #E2E8F0 !important;
    padding: 16px 20px !important;
}

div.card-header h1 {
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #1E293B !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0 !important;
}

.form-label {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #475569 !important;
    margin-bottom: 6px !important;
}

.form-control,
.form-select {
    border: 1px solid #E2E8F0 !important;
    border-radius: 8px !important;
    padding: 10px 14px !important;
    font-size: 14px !important;
    color: #1E293B !important;
    background-color: #FFFFFF !important;
    box-shadow: none !important;
    transition: all 0.2s ease !important;
}

.form-control:focus,
.form-select:focus {
    border-color: #0EA5E9 !important;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.12) !important;
}

.form-actions {
    margin-top: 32px;
    display: flex;
    gap: 12px;
}

.btn-submit {
    background: #0EA5E9 !important;
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

/* Baris item "isi paket" (produk + qty) */
.item-row {
    background-color: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 8px;
    padding: 10px 8px;
    margin-left: 0 !important;
    margin-right: 0 !important;
}

.btn-remove-item {
    border: 1px solid #E2E8F0 !important;
    color: #EF4444 !important;
    background: transparent !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    border-radius: 8px !important;
    padding: 10px 14px !important;
    transition: all 0.15s ease !important;
}

.btn-remove-item:hover {
    background: #FEF2F2 !important;
    border-color: #FCA5A5 !important;
    color: #DC2626 !important;
}

.btn-add-item {
    background: transparent !important;
    border: 1px solid #0EA5E9 !important;
    color: #0EA5E9 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 8px 16px !important;
    border-radius: 8px !important;
    box-shadow: none !important;
    transition: all 0.15s ease !important;
    cursor: pointer;
}

.btn-add-item:hover {
    background: #EFF6FF !important;
    border-color: #0284C7 !important;
    color: #0284C7 !important;
}
</style>

@if (!empty($paket->foto))
    <div class="mb-3">
        <label class="form-label">Foto Saat Ini</label><br>
        <img src="{{ asset('storage/' . $paket->foto) }}" width="150" class="img-thumbnail">
    </div>
@endif

<div class="row mb-3">
    <div class="col">
        <label class="form-label">Gambar</label>
        <input type="file" name="foto" onchange="previewImage(this)"
               class="form-control @error('foto') is-invalid @enderror">
        @error('foto')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label class="form-label">Preview Foto</label><br>
        <img id="preview" class="img-thumbnail" style="display: none; border-radius: 6px;" width="150">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Nama Paket</label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $paket->nama ?? '') }}" autocomplete="off">
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row mb-3">
    <div class="col">
        <label class="form-label">Harga Jual Paket</label>
        <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror"
               value="{{ old('harga_jual', $paket->harga_jual ?? '') }}">
        @error('harga_jual')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col">
        <label class="form-label">Stok Paket</label>
        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
               value="{{ old('stok', $paket->stok ?? '') }}">
        @error('stok')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<hr>

<div class="mb-2 d-flex justify-content-between align-items-center">
    <label class="form-label mb-0">Isi Paket (produk + jumlah per paket)</label>
    <button type="button" class="btn-add-item" id="btnAddItem">+ Tambah Produk</button>
</div>
@error('items')
    <div class="text-danger small mb-2">{{ $message }}</div>
@enderror

<div id="itemsWrapper"></div>

<template id="itemRowTemplate">
    <div class="row mb-2 align-items-center item-row mx-0">
        <div class="col-7">
            <select name="items[__INDEX__][produk_id]" class="form-select item-produk" required>
                <option value="">== Pilih Produk ==</option>
                @foreach ($produkList as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <input type="number" name="items[__INDEX__][qty]" class="form-control" placeholder="Qty" min="1" required>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-remove-item w-100">Hapus</button>
        </div>
    </div>
</template>

<div class="form-actions">
    <button class="btn-submit" type="submit">Simpan</button>
    <a href="{{ route('paket.index') }}" class="btn-cancel">Kembali</a>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const file = input.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}

(function () {
    const wrapper = document.getElementById('itemsWrapper');
    const template = document.getElementById('itemRowTemplate');
    const btnAdd = document.getElementById('btnAddItem');
    let rowIndex = 0;

    const existingItems = @json($existingItems ?? []);

    function addRow(produkId, qty) {
        const clone = template.content.cloneNode(true);
        clone.querySelectorAll('[name]').forEach(function (el) {
            el.name = el.name.replace('__INDEX__', rowIndex);
        });
        const select = clone.querySelector('.item-produk');
        const qtyInput = clone.querySelector('input[type=number]');
        if (produkId) select.value = produkId;
        if (qty) qtyInput.value = qty;

        clone.querySelector('.btn-remove-item').addEventListener('click', function (e) {
            e.target.closest('.item-row').remove();
        });

        wrapper.appendChild(clone);
        rowIndex++;
    }

    btnAdd.addEventListener('click', function () {
        addRow(null, null);
    });

    if (existingItems.length > 0) {
        existingItems.forEach(function (item) {
            addRow(item.produk_id, item.qty);
        });
    } else {
        addRow(null, null);
    }
})();
</script>