<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanService
{
   public function ringkasanHariIni(): array
   {
        $data = DB::table('penjualan')
            ->whereDate('created_at', Carbon::today())
            ->where('status', 'COMPLETED')
            ->selectRaw('
                COUNT(*) as total_transaksi,
                SUM(total_pembayaran) as total_penjualan,
                SUM(CASE WHEN metode_pembayaran = "CASH" THEN total_pembayaran ELSE 0 END) as total_cash,
                SUM(CASE WHEN metode_pembayaran != "CASH" THEN total_pembayaran ELSE 0 END) as total_non_tunai
            ')
            ->first();

        return [
            'total_transaksi' => $data->total_transaksi ?? 0,
            'total_penjualan' => $data->total_penjualan ?? 0,
            'total_cash' => $data->total_cash ?? 0,
            'total_non_tunai' => $data->total_non_tunai ?? 0,
        ];
   }

   public function produkTerlarisHariIni(int $limit = 5)
   {
        // Sumber 1: produk yang dibeli langsung/satuan (bukan lewat paket)
        $langsung = DB::table('item_penjualan')
            ->join('penjualan', 'penjualan.id', '=', 'item_penjualan.penjualan_id')
            ->whereDate('penjualan.created_at', Carbon::today())
            ->where('penjualan.status', 'COMPLETED')
            ->whereNotNull('item_penjualan.produk_id')
            ->select(
                'item_penjualan.produk_id as produk_id',
                DB::raw('item_penjualan.kuantitas as jumlah')
            );

        // Sumber 2: produk yang terjual sebagai bagian dari paket
        // (kuantitas paket yang laku dikali qty produk itu di dalam paket)
        $lewatPaket = DB::table('item_penjualan')
            ->join('penjualan', 'penjualan.id', '=', 'item_penjualan.penjualan_id')
            ->join('paket_item', 'paket_item.paket_id', '=', 'item_penjualan.paket_id')
            ->whereDate('penjualan.created_at', Carbon::today())
            ->where('penjualan.status', 'COMPLETED')
            ->whereNotNull('item_penjualan.paket_id')
            ->select(
                'paket_item.produk_id as produk_id',
                DB::raw('item_penjualan.kuantitas * paket_item.qty as jumlah')
            );

        // Gabungkan keduanya, lalu jumlahkan per produk
        return DB::query()
            ->fromSub($langsung->unionAll($lewatPaket), 'gabungan')
            ->join('produk', 'produk.id', '=', 'gabungan.produk_id')
            ->groupBy('produk.id', 'produk.nama', 'produk.stok')
            ->select(
                'produk.nama',
                'produk.stok',
                DB::raw('SUM(gabungan.jumlah) as total_terjual')
            )
            ->orderByDesc('total_terjual')
            ->limit($limit)
            ->get();
   }
}