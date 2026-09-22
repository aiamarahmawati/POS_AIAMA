<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // default: hari ini kalau belum ada filter tanggal
        $tanggalMulai = $request->filled('tanggal_mulai')
            ? Carbon::parse($request->tanggal_mulai)->startOfDay()
            : Carbon::today()->startOfDay();

        $tanggalAkhir = $request->filled('tanggal_akhir')
            ? Carbon::parse($request->tanggal_akhir)->endOfDay()
            : Carbon::today()->endOfDay();

        $penjualan = Penjualan::with('user')
            ->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPenjualan = $penjualan->where('status', 'COMPLETED')->sum('total_pembayaran');
        $jumlahTransaksi = $penjualan->count();

        return view('laporan.index', compact(
            'penjualan',
            'totalPenjualan',
            'jumlahTransaksi',
            'tanggalMulai',
            'tanggalAkhir'
        ));
    }
}