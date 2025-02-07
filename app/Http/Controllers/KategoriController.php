<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Middleware\isAdmin;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{

    public function index()
{
    $kategori = Kategori::orderBy('created_at', 'desc')->get();

    return view('admin.kategori.index', compact('kategori'));
}
    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:255|unique:kategoris',
    ], [
        'nama_kategori.required' => 'Nama Kategori harus terisi.',
    ]);

    $kategori = new Kategori;
    $kategori->nama_kategori = $request->input('nama_kategori');
    $kategori->slug = Str::slug($request->input('nama_kategori')); // ✅ Tambahkan slug
    $kategori->save();

    Alert::success('Success', 'Kategori berhasil ditambahkan.');

    return redirect()->route('kategori.index');
}

    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $slug)
{
    $kategori = Kategori::where('slug', $slug)->firstOrFail(); // ✅ Pastikan slug ditemukan

    $request->validate([
        'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->kategori_id . ',kategori_id',
    ]);

    $kategori->nama_kategori = $request->nama_kategori;
    $kategori->slug = Str::slug($request->nama_kategori);
    $kategori->save();

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
}


    public function destroy(string $kategori)
    {
        $kategori = Kategori::findOrFail($kategori);
        $kategori->delete();

        return redirect()->route('kategori.index');
    }
}
