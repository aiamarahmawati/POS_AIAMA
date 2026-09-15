<style>
  /* ---------- NAVBAR ---------- */

  .pos-navbar {
      background: #1E293B !important;
      padding: 12px 0;
      border-bottom: none;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
  }

  /* Default (desktop/tablet lebar): tetap SATU baris, sama seperti navbar aslinya.
     Baru dipecah jadi 2 baris (logo di atas, menu di bawah) saat layar sempit
     lewat media query di bagian bawah. */
  .pos-navbar-inner {
      display: flex;
      align-items: center;
      width: 100%;
  }

  .pos-navbar-top {
      display: flex;
      align-items: center;
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

  /* ---------- Tombol Hamburger (hanya tampil di layar kecil) ---------- */
  .pos-navbar-toggler {
      display: none;
      background: transparent;
      border: 1px solid rgba(148, 163, 184, 0.35);
      border-radius: 8px;
      width: 40px;
      height: 36px;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 5px;
      cursor: pointer;
      flex-shrink: 0;
  }

  .pos-navbar-toggler span {
      display: block;
      width: 20px;
      height: 2px;
      background: #F8FAFC;
      border-radius: 2px;
      transition: all 0.2s ease;
  }

  .pos-navbar-toggler.active span:nth-child(1) {
      transform: translateY(7px) rotate(45deg);
  }

  .pos-navbar-toggler.active span:nth-child(2) {
      opacity: 0;
  }

  .pos-navbar-toggler.active span:nth-child(3) {
      transform: translateY(-7px) rotate(-45deg);
  }

  /* flex: 1 supaya menu ini mengisi sisa ruang di sebelah logo (satu baris di desktop) */
  .pos-navbar-menu {
      display: flex;
      align-items: center;
      flex: 1;
      min-width: 0;
  }

  .pos-navbar-logout {
      margin-left: auto;
  }

  /* ---------- Tampilan Mobile & Tablet (di bawah 992px) ----------
     Di sinilah navbar baru dipecah jadi 2 baris: baris atas (logo + tombol
     hamburger), baris bawah (menu + logout) yang defaultnya disembunyikan. */
  @media (max-width: 991.98px) {
      .pos-navbar-inner {
          flex-direction: column;
          align-items: stretch;
      }

      .pos-navbar-top {
          justify-content: space-between;
          width: 100%;
      }

      .pos-navbar .navbar-brand-wrap {
          border-right: none;
          padding-right: 0;
          margin-right: 0;
      }

      .pos-navbar-toggler {
          display: flex;
      }

      .pos-navbar-menu {
          flex: none;
          display: none;
          flex-direction: column;
          align-items: stretch;
          width: 100%;
          margin-top: 14px;
          gap: 2px;
      }

      .pos-navbar-menu.show {
          display: flex;
      }

      .pos-navbar .navbar-nav {
          flex-direction: column !important;
          flex-wrap: nowrap !important;
          width: 100% !important;
          margin: 0 !important;
          gap: 2px;
      }

      .pos-navbar .nav-item {
          width: 100% !important;
      }

      .pos-navbar .nav-link {
          display: block !important;
          width: 100% !important;
          padding: 10px 12px !important;
          border-radius: 8px;
      }

      .pos-navbar .nav-link.active::after {
          display: none;
      }

      .pos-navbar .nav-link.active {
          background: rgba(14, 165, 233, 0.15);
      }

      .pos-navbar-logout {
          margin-left: 0;
          margin-top: 8px;
          width: 100%;
      }

      .pos-navbar-logout .btn-danger {
          width: 100%;
          padding: 10px;
      }
  }
</style>

<!-- Bootstrap Icons CDN (link lama sebelumnya tidak valid, sudah diperbaiki) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<nav class="navbar navbar-expand pos-navbar">
  <div class="container-fluid ps-4 pe-5 pos-navbar-inner">

    <div class="pos-navbar-top">
      <div class="navbar-brand-wrap">
        <span class="navbar-brand-logo-custom">
          <i class="bi bi-fire"></i>
        </span>
        <a class="navbar-brand" href="">Kedai Mercon</a>
      </div>

      <!-- Tombol hamburger: hanya muncul di HP/tablet -->
      <button class="pos-navbar-toggler" id="posNavbarToggler" type="button" aria-label="Buka menu navigasi" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    <div class="pos-navbar-menu" id="posNavbarMenu">
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

        <li class="nav-item">
          <a class="nav-link {{ Request::is('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
        </li>
      </ul>

      <form action="{{ route('logout') }}" method="POST" class="d-flex me-3 pos-navbar-logout">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>

  </div>
</nav>

<script>
(function () {
    var toggler = document.getElementById('posNavbarToggler');
    var menu = document.getElementById('posNavbarMenu');

    if (toggler && menu) {
        toggler.addEventListener('click', function () {
            var isOpen = menu.classList.toggle('show');
            toggler.classList.toggle('active', isOpen);
            toggler.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        // Tutup menu otomatis setelah salah satu link diklik (khusus mobile)
        menu.querySelectorAll('.nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('show');
                toggler.classList.remove('active');
                toggler.setAttribute('aria-expanded', 'false');
            });
        });
    }
})();
</script>