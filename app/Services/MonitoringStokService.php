<?php

namespace App\Services;

use App\Models\Paket;
use App\Models\Produk;
use Illuminate\Pagination\LengthAwarePaginator;

class MonitoringStokService
{
    public function produkStokRendah(int $batas = 5, int $perPage = 5)
    {
        $produk = Produk::where('stok', '>', 0)
            ->where('stok', '<=', $batas)
            ->get()
            ->map(function ($item) {
                $item->jenis_item = 'Produk';
                return $item;
            });

        $paket = Paket::where('stok', '>', 0)
            ->where('stok', '<=', $batas)
            ->get()
            ->map(function ($item) {
                $item->jenis_item = 'Paket';
                return $item;
            });

        $gabungan = $produk->concat($paket)->sortBy('stok')->values();

        return $this->paginateCollection($gabungan, $perPage, 'stok_rendah_page');
    }

    public function produkStokHabis(int $perPage = 5)
    {
        $produk = Produk::where('stok', 0)
            ->get()
            ->map(function ($item) {
                $item->jenis_item = 'Produk';
                return $item;
            });

        $paket = Paket::where('stok', 0)
            ->get()
            ->map(function ($item) {
                $item->jenis_item = 'Paket';
                return $item;
            });

        $gabungan = $produk->concat($paket)->sortBy('nama')->values();

        return $this->paginateCollection($gabungan, $perPage, 'stok_habis_page');
    }

    /**
     * Bikin paginator manual dari Collection gabungan Produk + Paket,
     * supaya di view tetap bisa dipakai persis seperti sebelumnya (->links(), ->firstItem(), dst).
     */
    private function paginateCollection($items, int $perPage, string $pageName)
    {
        $page = LengthAwarePaginator::resolveCurrentPage($pageName);
        $slice = $items->slice(($page - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $slice,
            $items->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}