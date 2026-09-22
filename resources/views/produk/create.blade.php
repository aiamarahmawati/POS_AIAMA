@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="d-flex justify-content-center" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="w-100" style="max-width: 600px; padding: 0 16px;">
        <div class="card bg-white">
            <div class="card-header">
                <h1>Tambah Produk Baru</h1>
            </div>
            <div class="card-body" style="padding: 24px 20px;">
                <form action="{{ route('produk.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @include('produk._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection