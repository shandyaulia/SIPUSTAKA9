<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;

class OpacController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('penulis', 'like', '%' . $request->search . '%');
        }

        $buku = $query->paginate(12);

        return view('opac.index', compact('buku'));
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('opac.show', compact('buku'));
    }
}
