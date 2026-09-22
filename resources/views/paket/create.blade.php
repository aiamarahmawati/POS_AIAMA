@extends('layouts.app')

@section('title', 'Tambah Paket')

@section('content')
<div class="d-flex justify-content-center" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="w-100" style="max-width: 700px; padding: 0 16px;">
        <div class="card bg-white">
            <div class="card-header">
                <h1>Tambah Paket Baru</h1>
            </div>
            <div class="card-body" style="padding: 24px 20px;">
                <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                    @php $existingItems = old('items', []); @endphp
                    @include('paket._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection