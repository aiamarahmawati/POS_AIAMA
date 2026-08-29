<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            JenisSeeder::class,     // 1. Disisipkan di sini agar jenis dibuat sebelum produk
            ProdukSeeder::class,    // 2. Produk sekarang aman mengambil ID dari JenisSeeder
            PenjualanSeeder::class
        ]);
        
        // Baris kode duplikat di bawah ini telah dihapus agar database bersih dan tidak error 
    }
}
