<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategori = KategoriBuku::paginate(10);
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_buku,nama_kategori',
        ]);

        KategoriBuku::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    public function edit(KategoriBuku $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriBuku $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_buku,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Diperbarui');
    }

    public function destroy(KategoriBuku $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Dihapus');
    }
}
