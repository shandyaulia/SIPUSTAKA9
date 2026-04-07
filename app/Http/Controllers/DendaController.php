<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
            $denda = Denda::with('peminjaman.user')->latest()->paginate(15);
        } else {
            $denda = Denda::with('peminjaman.user')
                ->whereHas('peminjaman', function($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->latest()
                ->paginate(15);
        }

        return view('denda.index', compact('denda'));
    }

    public function update(Request $request, Denda $denda)
    {
        // Admin or super admin pays the denda
        if (!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin')) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }

        $request->validate([
            'status_bayar' => 'required|in:belum_lunas,lunas',
        ]);

        $denda->update([
            'status_bayar' => $request->status_bayar
        ]);

        return back()->with('success', 'Status pembayaran denda berhasil diperbarui.');
    }
}
