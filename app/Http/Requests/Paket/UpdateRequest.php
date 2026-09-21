<?php

namespace App\Http\Requests\Paket;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama'        => ['required', 'string', 'max:255'],
            'foto'        => ['nullable', 'image', 'max:2048'],
            'harga_jual'  => ['required', 'integer', 'min:0'],
            'stok'        => ['required', 'integer', 'min:0'],
            'items'                => ['required', 'array', 'min:1'],
            'items.*.produk_id'    => ['required', 'integer', 'exists:produk,id', 'distinct'],
            'items.*.qty'          => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'items.required'             => 'Paket harus berisi minimal 1 produk.',
            'items.*.produk_id.distinct' => 'Produk yang sama tidak boleh dipilih dua kali dalam satu paket.',
            'items.*.produk_id.exists'   => 'Salah satu produk yang dipilih tidak valid.',
        ];
    }
}