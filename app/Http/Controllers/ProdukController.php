<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Menampilkan form tambah produk
    $produk = Produk::all();
        $kategori = Kategori::all();
        return view('admin.produk.create', compact('kategori','produk'));
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // Validasi data input
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
        'harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
        'kategori_id' => 'required|exists:kategoris,kategori_id',
        'brand_name' => 'nullable|string|max:255',
    ]);

    // Simpan produk ke database
    $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        if ($request->hasFile('gambar')) {
            $img = $request->file('gambar');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move(public_path('/images/produk'), $name);
            $produk->gambar = $name;
        }
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->kategori_id = $request->kategori_id;
        $produk->brand_name = $request->brand_name;
        $produk->slug = Str::slug($request->nama_produk);
        // Tambahkan slug otomatis

        $produk->save();
        
    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
}


    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
{
    return view('admin.produk.show', compact('produk'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
{
    $kategori = Kategori::all();
    $produk = Produk::all();
    return view('admin.produk.edit', compact('produk', 'kategori'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255|unique:produks,nama_produk,' . $produk->id,
        'gambar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        'harga' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
        'kategori_id' => 'required|exists:kategoris,kategori_id',
        'brand_name' => 'required|string|max:255',
    ]);

    $produk->nama_produk = $request->nama_produk;
        if ($request->hasFile('gambar')) {
            $img = $request->file('gambar');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move(public_path('/images/produk'), $name);
            $produk->gambar = $name;
        }
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->deskripsi = $request->deskripsi;
        $produk->kategori_id = $request->kategori_id;
        $produk->brand_name = $request->brand_name;
        $produk->slug = Str::slug($request->nama_produk);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
{
    $produk->delete();
    return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
}
}
