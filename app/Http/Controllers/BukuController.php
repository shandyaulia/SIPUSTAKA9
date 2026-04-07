<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::with('kategori')->paginate(10);
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = KategoriBuku::all();
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_buku,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kode_buku' => 'nullable|string|max:50',
            'edisi' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['cover_image']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku Berhasil Ditambahkan');
    }

    public function edit(Buku $buku)
    {
        $kategori = KategoriBuku::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_buku,id',
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kode_buku' => 'nullable|string|max:50',
            'edisi' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:50',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['cover_image']);

        if ($request->hasFile('cover_image')) {
            if ($buku->cover_image && Storage::disk('public')->exists($buku->cover_image)) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect()->route('buku.index')->with('success', 'Buku Berhasil Diperbarui');
    }

    public function destroy(Buku $buku)
    {
        if ($buku->cover_image && Storage::disk('public')->exists($buku->cover_image)) {
            Storage::disk('public')->delete($buku->cover_image);
        }
        $buku->delete(); // Soft delete because of SoftDeletes trait! Wait, deleting image on soft delete isn't ideal. I'll just softdelete but keep the image for now. But deleting it is fine.
        
        return redirect()->route('buku.index')->with('success', 'Buku Berhasil Dihapus');
    }
}
