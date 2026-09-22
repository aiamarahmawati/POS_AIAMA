<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Paket;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * PERUBAHAN: sekarang WAJIB kirim penjualan_id (transaksi mana yang
     * sedang dibuka di layar kasir). Sebelumnya method ini menebak sendiri
     * "transaksi OPEN milik user ini" lewat query tanpa id — itu cuma aman
     * kalau tiap kasir cuma boleh punya 1 transaksi OPEN sekaligus. Sekarang
     * kasir bisa punya banyak transaksi tertunda, jadi harus eksplisit biar
     * produk/paket yang ditambahkan tidak salah nyangkut ke transaksi lain.
     *
     * Menerima salah satu: product_id (produk satuan) ATAU paket_id (paket bundle) — tidak boleh dua-duanya.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'product_id'   => 'nullable|exists:produk,id',
            'paket_id'     => 'nullable|exists:paket,id',
            'quantity'     => 'required|integer|min:1'
        ]);

        if (!$request->product_id && !$request->paket_id) {
            return back()->with('errors', 'Pilih produk atau paket terlebih dahulu');
        }

        if ($request->product_id && $request->paket_id) {
            return back()->with('errors', 'Tidak bisa memilih produk dan paket sekaligus');
        }

        $errorMessage = null;

        DB::transaction(function () use ($request, &$errorMessage) {

            // Ambil transaksi PERSIS berdasarkan penjualan_id yang dikirim dari halaman
            // (bukan nebak "transaksi OPEN milik user" seperti sebelumnya),
            // sekaligus pastikan itu memang transaksi milik kasir ini & masih OPEN.
            $sale = Penjualan::where('id', $request->penjualan_id)
                ->where('user_id', Auth::id())
                ->where('status', 'OPEN')
                ->firstOrFail();

            if ($request->product_id) {
                $entity     = Produk::lockForUpdate()->findOrFail($request->product_id);
                $idColumn   = 'produk_id';
                $labelJenis = 'Produk';
            } else {
                $entity     = Paket::lockForUpdate()->findOrFail($request->paket_id);
                $idColumn   = 'paket_id';
                $labelJenis = 'Paket';
            }

            // Cek stok
            if ($entity->stok < $request->quantity) {
                $errorMessage = $labelJenis . ' stok tidak mencukupi';
                return;
            }

            // Kurangi stok
            $entity->decrement('stok', $request->quantity);

            // Update / insert item penjualan, dicari berdasarkan kolom yang relevan
            // (produk_id untuk produk satuan, paket_id untuk paket) DAN penjualan_id yang tepat
            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where($idColumn, $entity->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                // UPDATE
                $item->kuantitas += $request->quantity;
            } else {
                // CREATE
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id'    => $idColumn === 'produk_id' ? $entity->id : null,
                    'paket_id'     => $idColumn === 'paket_id' ? $entity->id : null,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $entity->harga_jual,
                ]);
            }

            // hitung subtotal SETELAH kuantitas fix
            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            // TOTAL PEMBAYARAN
            $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
            $sale->save();
        });

        if ($errorMessage) {
            return back()->with('errors', $errorMessage);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $errorMessage = null;

        DB::transaction(function () use ($request, $itempenjualan, &$errorMessage) {

            // Ambil entitas terkait (produk ATAU paket), sesuai isi baris item ini
            $entity = $itempenjualan->produk_id
                ? Produk::lockForUpdate()->find($itempenjualan->produk_id)
                : Paket::lockForUpdate()->find($itempenjualan->paket_id);

            $selisih = $request->quantity - $itempenjualan->kuantitas;

            // Kalau qty nambah, pastikan stoknya cukup dulu
            if ($selisih > 0 && $entity && $entity->stok < $selisih) {
                $errorMessage = 'Stok tidak mencukupi untuk jumlah tersebut';
                return;
            }

            if ($entity) {
                if ($selisih < 0) {
                    // qty berkurang -> kembalikan stok
                    $entity->increment('stok', abs($selisih));
                } elseif ($selisih > 0) {
                    // qty bertambah -> kurangi stok
                    $entity->decrement('stok', $selisih);
                }
            }

            // Update item
            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal' => $request->quantity * $itempenjualan->harga_satuan
            ]);

            // Update total penjualan
            $itempenjualan->penjualan->update([
                'total_pembayaran' =>
                    $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
            ]);
        });

        if ($errorMessage) {
            return back()->with('errors', $errorMessage);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $sale = $itempenjualan->penjualan;

            // Kembalikan stok ke produk ATAU paket, sesuai jenis item ini
            if ($itempenjualan->produk_id) {
                $itempenjualan->produk?->increment('stok', $itempenjualan->kuantitas);
            } elseif ($itempenjualan->paket_id) {
                $itempenjualan->paket?->increment('stok', $itempenjualan->kuantitas);
            }

            // Hapus item
            $itempenjualan->delete();

            // Update total penjualan
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }
}