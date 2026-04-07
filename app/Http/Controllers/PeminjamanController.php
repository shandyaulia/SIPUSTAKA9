<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Buku;
use App\Models\Denda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $queryAktif = Peminjaman::with(['user', 'detailPeminjaman.buku', 'denda'])
            ->whereNotIn('status', ['dikembalikan', 'ditolak']);

        if (!$user->hasRole('Super Admin') && !$user->hasRole('Admin')) {
            $queryAktif->where('user_id', $user->id);
        }
        
        $peminjaman = $queryAktif->latest('tanggal_pinjam')->paginate(15);

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        // For User to request a book
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        
        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        // Create Peminjaman record
        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'tanggal_pinjam' => Carbon::today(),
            'tenggat_waktu' => Carbon::today()->addDays(7), // default 7 days borrow period
            'status' => 'pending'
        ]);

        DetailPeminjaman::create([
            'peminjaman_id' => $peminjaman->id,
            'buku_id' => $buku->id
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Permintaan peminjaman berhasil dikirim. Silakan tunggu konfirmasi Admin.');
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        // For Admin to change status
        if (!auth()->user()->hasRole('Super Admin') && !auth()->user()->hasRole('Admin')) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }

        $request->validate([
            'status' => 'required|in:pending,dipinjam,dikembalikan,ditolak',
        ]);

        $oldStatus = $peminjaman->status;
        $newStatus = $request->status;

        $peminjaman->status = $newStatus;

        if ($newStatus == 'dipinjam' && $oldStatus == 'pending') {
            // Kuota stok minus 1
            foreach ($peminjaman->detailPeminjaman as $detail) {
                if ($detail->buku->stok > 0) {
                    $detail->buku->decrement('stok');
                } else {
                    return back()->with('error', 'Stok buku ' . $detail->buku->judul . ' tidak mencukupi.');
                }
            }
        } elseif ($newStatus == 'dikembalikan' && in_array($oldStatus, ['dipinjam', 'telat'])) {
            $peminjaman->tanggal_kembali = Carbon::today();
            // Kembalikan stok
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $detail->buku->increment('stok');
            }

            // Hitung denda jika telat (Rp 2000 per hari let's say)
            $tenggat = Carbon::parse($peminjaman->tenggat_waktu);
            $sekarang = Carbon::today();
            
            if ($sekarang->gt($tenggat)) {
                $selisih = $sekarang->diffInDays($tenggat);
                $dendaRp = $selisih * 2000;
                
                Denda::create([
                    'peminjaman_id' => $peminjaman->id,
                    'jumlah_denda' => $dendaRp,
                    'status_bayar' => 'belum_lunas'
                ]);
            }
        } elseif ($newStatus == 'ditolak' && $oldStatus == 'pending') {
            // do nothing since stock wasn't minused
        }

        $peminjaman->save();

        return back()->with('success', 'Status peminjaman berhasil diperbarui.');
    }
}
