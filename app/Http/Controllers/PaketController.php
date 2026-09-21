<?php
 
namespace App\Http\Controllers;
 
use App\Http\Requests\Paket\StoreRequest;
use App\Http\Requests\Paket\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Paket;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
 
class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Paket::class);
 
        $keyword = $request->input('search');
 
        if ($keyword) {
            $pakets = Paket::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->with('items.produk')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
        } else {
            $pakets = Paket::with('items.produk')->latest()->paginate(10)->withQueryString();
        }
 
        return view('paket.index', compact('pakets'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Paket::class);
 
        $produkList = Produk::orderBy('nama')->get();
 
        return view('paket.create', compact('produkList'));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Paket::class);
 
        $dataReq = $request->validated();
 
        DB::transaction(function () use ($dataReq, $request) {
            $data['user_id']     = Auth::id();
            $data['nama']        = $dataReq['nama'];
            $data['harga_jual']  = $dataReq['harga_jual'];
            $data['stok']        = $dataReq['stok'];
 
            if ($request->hasFile('foto')) {
                $data['foto'] = $request->file('foto')->store('paket', 'public');
            }
 
            $paket = Paket::create($data);
 
            foreach ($dataReq['items'] as $item) {
                $paket->items()->create([
                    'produk_id' => $item['produk_id'],
                    'qty'       => $item['qty'],
                ]);
            }
        });
 
        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        $this->authorize('update', $paket);
 
        $produkList = Produk::orderBy('nama')->get();
        $paket->load('items');
 
        return view('paket.edit', compact('paket', 'produkList'));
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Paket $paket)
    {
        $this->authorize('update', $paket);
 
        $dataReq = $request->validated();
 
        DB::transaction(function () use ($dataReq, $request, $paket) {
            $data = [
                'nama'       => $dataReq['nama'],
                'harga_jual' => $dataReq['harga_jual'],
                'stok'       => $dataReq['stok'],
            ];
 
            if ($request->hasFile('foto')) {
                if ($paket->foto && Storage::disk('public')->exists($paket->foto)) {
                    Storage::disk('public')->delete($paket->foto);
                }
                $data['foto'] = $request->file('foto')->store('paket', 'public');
            }
 
            $paket->update($data);
 
            // Ganti seluruh isi paket dengan yang baru dikirim dari form
            $paket->items()->delete();
            foreach ($dataReq['items'] as $item) {
                $paket->items()->create([
                    'produk_id' => $item['produk_id'],
                    'qty'       => $item['qty'],
                ]);
            }
        });
 
        return redirect()->route('paket.edit', $paket->id)->with('success', 'Paket berhasil diperbarui.');
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $this->authorize('delete', $paket);
 
        if ($paket->foto && Storage::disk('public')->exists($paket->foto)) {
            Storage::disk('public')->delete($paket->foto);
        }
 
        // items ikut terhapus otomatis lewat cascadeOnDelete() di migration paket_item
        $paket->delete();
 
        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}