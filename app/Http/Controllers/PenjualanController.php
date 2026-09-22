<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Paket;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()

            // Filter berdasarkan role
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })

            // Search nama user
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * PERUBAHAN: sebelumnya pakai firstOrCreate (nyambung ke transaksi OPEN
     * yang sudah ada kalau masih ada), sekarang SELALU bikin transaksi baru,
     * lalu diarahkan ke halaman edit transaksi itu. Ini yang memungkinkan
     * kasir mulai transaksi baru walau masih ada transaksi lain yang tertunda.
     */
    public function create()
    {
        $sale = Penjualan::create([
            'user_id'           => Auth::id(),
            'status'            => 'OPEN',
            'total_pembayaran'  => 0,
            'metode_pembayaran' => 'CASH',
        ]);

        return redirect()->route('penjualan.edit', $sale);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // GANTI nama fungsi menjadi show
    public function show($id)
    {
        // Mengambil data penjualan beserta kasir (user) dan item produk/paket yang dibeli
        $sale = Penjualan::with(['user', 'itemPenjualan.produk', 'itemPenjualan.paket'])->findOrFail($id);

        // Tetap mengarahkan ke halaman detail baru Anda
        return view('penjualan.detail', compact('sale'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * PERUBAHAN: sekarang halaman ini jadi satu-satunya halaman kerja POS,
     * dipakai baik untuk transaksi yang baru saja dibuat (dari create())
     * maupun transaksi tertunda yang dibuka lagi lewat tombol Edit di index.
     * Karena itu ditambahkan: (1) pencarian produk/paket seperti yang
     * sebelumnya ada di create(), dan (2) pengecekan supaya kasir tidak
     * bisa membuka transaksi tertunda milik kasir lain lewat tebak-tebak URL.
     */
    public function edit(SearchRequest $request, Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        // Kasir hanya boleh buka transaksinya sendiri; admin boleh buka semua
        if (Auth::user()->role->name === 'kasir' && $sale->user_id !== Auth::id()) {
            abort(403);
        }

        $sale->load('itemPenjualan');

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::where('nama', 'like', '%' . $keyword . '%')
                ->orderBy('nama')
                ->get();

            $packages = Paket::where('nama', 'like', '%' . $keyword . '%')
                ->orderBy('nama')
                ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
            $packages = Paket::orderBy('nama')->get();
        }

        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'packages', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        // Menambahkan kustomisasi teks error ke bahasa Indonesia
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS',
            'uang_masuk'     => 'required_if:payment_method,CASH|nullable|numeric|min:0',
        ], [
            'payment_method.required' => 'Silakan pilih metode pembayaran terlebih dahulu!',
            'payment_method.in'       => 'Metode pembayaran tidak valid!',
            'uang_masuk.required_if'  => 'Uang masuk wajib diisi untuk pembayaran Cash!',
            'uang_masuk.numeric'      => 'Uang masuk harus berupa angka!',
            'uang_masuk.min'          => 'Uang masuk tidak boleh negatif!',
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        // Hitung ulang total (anti manipulasi) SEBELUM masuk transaction,
        // karena kita butuh angka ini untuk validasi uang masuk Cash
        $total = $penjualan->itemPenjualan()->sum('subtotal');

        $uangMasuk = 0;
        $kembalian = 0;

        if ($request->payment_method === 'CASH') {
            $uangMasuk = (int) $request->uang_masuk;

            // Validasi ulang di server (anti manipulasi, jangan percaya JS)
            if ($uangMasuk < $total) {
                return back()
                    ->withInput()
                    ->with('errors', 'Uang masuk kurang dari total pembayaran');
            }

            $kembalian = $uangMasuk - $total;
        }

        DB::transaction(function () use ($penjualan, $request, $total, $uangMasuk, $kembalian) {
            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'uang_masuk'        => $uangMasuk,
                'kembalian'         => $kembalian,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        // Pastikan hanya transaksi OPEN
        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.index')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {

            foreach ($penjualan->itemPenjualan as $item) {
                // kembalikan stok, sesuai jenis item-nya (produk satuan atau paket)
                if ($item->produk_id) {
                    $item->produk?->increment('stok', $item->kuantitas);
                } elseif ($item->paket_id) {
                    $item->paket?->increment('stok', $item->kuantitas);
                }
            }

            // hapus item
            $penjualan->itemPenjualan()->delete();

            // hapus penjualan
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}