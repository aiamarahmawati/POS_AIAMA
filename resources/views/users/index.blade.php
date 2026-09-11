@extends('layouts.app')

@section('title', 'Users')

@include('layouts.navbar')

@section('content')

<style>
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
    <!-- Tambahkan pembungkus kontainer ini agar jarak kanan kirinya seimbang -->
    <div class="container mt-4">

        <h1 class="mb-4">Users</h1>

        <div class="table-filter-action">
            <form action="{{ route('admin.users') }}" method="GET" class="search-wrapper">
                <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                    placeholder="Cari nama atau email..." autocomplete="off">
                <button class="search-btn" type="submit">Cari</button>
            </form>

            <a href="{{ route('admin.users.create') }}" class="btn-create-user">
                + Tambah User
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 200px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge-role {{ Str::slug($user->role->name) }}">
                                    {{ $user->role->name }}
                                </span>
                            </td>
                            <!-- Cari bagian loop tabel aksi Anda, ganti menjadi struktur super rapi ini: -->
                            <td>
                                <div class="d-flex gap-2 justify-content-end align-items-center">
                                    <!-- TOMBOL EDIT: Ditambah class py-1 px-2 lh-sm fs-7 -->
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-action-edit py-1 px-2 lh-sm" style="font-size: 13px !important;">
                                        Edit Akun
                                    </a>
                                    <!-- TOMBOL HAPUS: Disamakan class padding-nya py-1 px-2 lh-sm -->
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                        class="d-inline m-0 p-0"
                                        data-confirm="Apakah Anda yakin akan menghapus user &quot;{{ $user->name }}&quot;?"
                                        data-confirm-danger="true"
                                        data-confirm-ok-text="Ya, Hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action-delete py-1 px-2 lh-sm"
                                            style="font-size: 13px !important;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

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