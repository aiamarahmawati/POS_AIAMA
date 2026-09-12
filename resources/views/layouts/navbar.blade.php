<style>
  /* ---------- NAVBAR ---------- */

  .pos-navbar {
      background: #1E293B !important;
      padding: 12px 0;
      border-bottom: none;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
  }

  /* Bungkus brand + ikon supaya bisa diberi jarak & garis pemisah dari menu */
  .pos-navbar .navbar-brand-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      padding-right: 24px;
      margin-right: 24px;
      border-right: 1px solid rgba(148, 163, 184, 0.25);
  }

  /* KUSTOMISASI LOGO KODE (API MERCON GRADASI) */
  .pos-navbar .navbar-brand-logo-custom {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 10px;
      /* Background hitam pekat dengan border merah tipis menyala */
      background: #0F172A;
      border: 1px solid rgba(239, 68, 68, 0.4);
      font-size: 20px;
      flex-shrink: 0;
      box-shadow: 0 0 10px rgba(239, 68, 68, 0.2);
  }

  /* Warna icon api dibuat gradasi merah ke kuning emas */
  .pos-navbar .navbar-brand-logo-custom i {
      background: linear-gradient(135deg, #EF4444 0%, #F59E0B 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
  }

  .pos-navbar .navbar-brand {
      font-weight: 800;
      font-size: 21px;
      color: #FFFFFF !important;
      letter-spacing: 0.2px;
      line-height: 1;
      margin: 0;
      padding: 0;
      white-space: nowrap;
  }

  .pos-navbar .nav-link {
      color: #94A3B8 !important;
      font-size: 14px;
      font-weight: 500;
      padding: 8px 16px !important;
      position: relative;
      display: inline-block;
      transition: color 0.2s ease;
  }

  .pos-navbar .nav-link:hover {
      color: #F8FAFC !important;
  }

  .pos-navbar .nav-link.active {
      color: #FFFFFF !important;
      font-weight: 600;
  }

  .pos-navbar .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 16px;
      right: 16px;
      height: 3px;
      background-color: #0EA5E9;
      border-radius: 2px;
  }

  .pos-navbar .btn-danger {
      background: #EF4444;
      border: none;
      color: #FFFFFF !important;
      font-size: 13px;
      font-weight: 600;
      padding: 6px 16px;
      border-radius: 6px;
      transition: background-color 0.2s ease;
  }

  .pos-navbar .btn-danger:hover {
      background: #DC2626;
  }
</style>

<!-- Pastikan load CDN Bootstrap Icons di paling atas jika belum ada -->
<link rel="stylesheet" href="https://jsdelivr.net">

<nav class="navbar navbar-expand pos-navbar">
  <!-- MENGGUNAKAN container-fluid AGAR LOGO TETAP DI KIRI, DAN BERI pe-5 AGAR SISI KANAN (LOGOUT) MEMILIKI JARAK AMAN -->
  <div class="container-fluid ps-4 pe-5">
    <div class="navbar-brand-wrap">
      <!-- LOGO BARU KODE: Menggantikan emoticon sate lama dengan ikon Api Mercon Modern -->
      <span class="navbar-brand-logo-custom">
        <i class="bi bi-fire"></i>
      </span>
      <a class="navbar-brand" href="{{ route('dashboard') }}">Kedai Mercon</a>
    </div>

    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
      </li>
      {{-- Menu users hanya untuk admin (role_id = 1) --}}
      @if(auth()->user()->role_id === 1)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
      @endif

      @if(auth()->user()->role_id === 1)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}">Jenis</a>
        </li>
      @endif

      <li class="nav-item">
        <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
      </li>
    </ul>

    <!-- DIBERI me-3 PADA FORM UNTUK JALUR AMAN TAMBAHAN AGAR LOGOUT SEMAKIN PROPORSIONAL -->
    <form action="{{ route('logout') }}" method="POST" class="d-flex me-3">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
    </form>
  </div>
</nav>