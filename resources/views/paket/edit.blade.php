@extends('layouts.app')

@section('title', 'Edit Paket')

@section('content')
<div class="position-relative w-100" style="min-height: 80vh; padding-top: 40px;">
    <div class="position-absolute start-50 translate-middle-x w-100" style="max-width: 700px; padding: 0 16px;">
        <div class="card bg-white">
            <div class="card-header">
                <h1>Edit Paket</h1>
            </div>
            <div class="card-body" style="padding: 24px 20px;">
                <form action="{{ route('paket.update', $paket) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @php
                        $existingItems = old('items', $paket->items->map(function ($item) {
                            return ['produk_id' => $item->produk_id, 'qty' => $item->qty];
                        })->toArray());
                    @endphp
                    @include('paket._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection