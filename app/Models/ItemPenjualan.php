<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPenjualan extends Model
{
    use HasFactory;

    protected $table = 'item_penjualan';

    protected $fillable = [
        'penjualan_id',
        'produk_id',
        'paket_id',
        'kuantitas',
        'harga_satuan',
        'subtotal'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    /**
     * Nama item ini untuk ditampilkan (bisa dari produk satuan atau dari paket).
     */
    public function getNamaItemAttribute()
    {
        return $this->produk->nama ?? $this->paket->nama ?? 'Item dihapus';
    }

    /**
     * True kalau baris ini adalah paket, bukan produk satuan.
     */
    public function getIsPaketAttribute()
    {
        return !is_null($this->paket_id);
    }
}