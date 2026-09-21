<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class PaketItem extends Model
{
    use HasFactory;
 
    protected $table = 'paket_item';
 
    protected $fillable = [
        'paket_id',
        'produk_id',
        'qty',
    ];
 
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
 
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}