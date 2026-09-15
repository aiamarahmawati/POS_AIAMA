<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- PENTING: meta viewport ini WAJIB ada supaya browser HP/tablet me-render
         halaman sesuai lebar layar aslinya, bukan di-zoom-out seperti tampilan desktop.
         Ini adalah penyebab utama kenapa aplikasi terlihat tidak responsif di HP. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <!-- Isi title yang kita kirimkan dari views lain -->
    <title>@yield('title')</title>
    <!-- memanggil link bootstraps  -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Stylesheet responsif tambahan: berlaku otomatis untuk SEMUA halaman
         karena file ini di-include di layout utama -->
    @include('layouts.responsive')
</head>
<body>
    
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Isi konten yang kita kirimkan dari views lain -->
        @yield('content')

    </div>

</body>
</html>