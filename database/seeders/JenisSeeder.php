<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Makanan', 'Minuman', 'Elektronik', 'Pakaian'];

        foreach ($kategori as $item) {
            // firstOrCreate mencegah error jika data dengan nama yang sama sudah ada
            Jenis::firstOrCreate(['nama' => $item]); 
        }
    }
}
