<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Paket extends Model
{
    use HasFactory;
 
    protected $table = 'paket';
 
    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'harga_jual',
        'stok',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    /**
     * Baris breakdown isi paket (produk_id + qty).
     */
    public function items()
    {
        return $this->hasMany(PaketItem::class, 'paket_id');
    }
 
    /**
     * Produk-produk yang ada di dalam paket ini, lengkap dengan qty (pivot).
     */
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'paket_item', 'paket_id', 'produk_id')
            ->withPivot('qty')
            ->withTimestamps();
    }
}