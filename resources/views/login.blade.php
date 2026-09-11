<!-- memanggil file app.blade.php -->
@extends('layouts.app')

<!-- mengirimkan nilai ke title untuk ditampilkan -->
@section('title', 'Login')

<!-- batas awal isi konten  -->
@section('content')

<style>
/* ==========================================================================
   1. KHUSUS STYLING HALAMAN LOGIN (DIKUNCI TOTAL & AMAN)
   ========================================================================== */
.halaman-login-khusus .card-header {
    text-align: center !important;
    background-color: #ffffff !important;
    border-bottom: 1px solid #f1f5f9 !important;
    padding: 20px !important;
}

.halaman-login-khusus .card-header h1 {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    letter-spacing: 0.5px !important;
    margin: 0 auto !important;
    text-transform: uppercase;
    text-align: center !important;
    display: block !important;
}

.halaman-login-khusus .card-body {
    text-align: left !important;
    display: block !important;
    height: auto !important;
    min-height: auto !important;
    padding: 24px 20px !important;
}

.halaman-login-khusus .form-control {
    text-align: left !important;
}

/* Fokus input merubah glow biru menjadi hitam slate POS */
.halaman-login-khusus .form-control:focus {
    border-color: #1e293b !important;
    box-shadow: 0 0 0 3px rgba(30, 41, 59, 0.12) !important;
    outline: none !important;
}

.halaman-login-khusus button.btn-submit {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    background-color: #1e293b !important; /* Warna Hitam POS */
    border: 1px solid #1e293b !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    padding: 12px 24px !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    box-shadow: 0 1px 2px 0 rgba(30, 41, 59, 0.1) !important;
    transition: all 0.2s ease !important;
}

.halaman-login-khusus button.btn-submit:hover {
    background-color: #0f172a !important;
    border-color: #0f172a !important;
}

</style>

<!-- KODE PENGUNCI: Memisahkan halaman login agar dashboard tidak ikut merusak -->
<div class="halaman-login-khusus">

    <div class="card position-absolute top-50 start-50 translate-middle w-100" style="max-width: 400px; padding: 0 12px;">
      
      <div class="card-header" style="border: none !important; border-bottom: none !important;">
         <h1>LOGIN KEDAI MERCON</h1>
      </div>
      
      <div class="card-body">
        <form action="{{ route('auth') }}" method="POST">
            @csrf
            
            <div class="mb-3 text-start">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
                @error('email')
                    <div class="text-danger-custom mt-1" style="font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-4 text-start">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                @error('password')
                    <div class="text-danger-custom mt-1" style="font-size: 13px;">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-submit w-100 text-center justify-content-center">Login</button>
        </form>
      </div>
    </div>

</div>
<!-- batas akhir isi konten  -->
@endsection
