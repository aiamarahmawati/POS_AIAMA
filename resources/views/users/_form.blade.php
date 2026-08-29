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
    <label class="form-label">Nama</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name ?? '') }}" autocomplete="off">
    @error('name')
           <div class="invalid-feedback">
            {{ $message }}
           </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email ?? '') }}" autocomplete="off">
    @error('email')
           <div class="invalid-feedback">
            {{ $message }}
           </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password"
           class="form-control @error('password') is-invalid @enderror">
    @error('password')
           <div class="invalid-feedback">
            {{ $message }}
           </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role_id"
            class="form-select @error('role_id') is-invalid @enderror">
        <option value="">== Pilih Role ==</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}"
                @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select> <!-- PENUTUP SELECT SUDAH DIPERBAIKI DI SINI -->
    @error('role_id')
           <div class="invalid-feedback">
            {{ $message }}
           </div>
    @enderror
</div>

<div class="form-actions">
    <button type="submit" class="btn-submit">Simpan</button>
    <a href="{{ route('admin.users') }}" class="btn-cancel">Kembali</a>
</div>
