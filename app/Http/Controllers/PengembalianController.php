<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $query = Peminjaman::with(['user', 'detailPeminjaman.buku', 'denda'])
            ->whereIn('status', ['dikembalikan', 'ditolak']);

        if (!$user->hasRole('Super Admin') && !$user->hasRole('Admin')) {
            $query->where('user_id', $user->id);
        }
        
        $pengembalian = $query->latest('updated_at')->paginate(15);

        return view('pengembalian.index', compact('pengembalian'));
    }
}
