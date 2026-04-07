<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
            // Get Peminjaman data for chart (current year)
            $peminjamanYear = \App\Models\Peminjaman::whereYear('tanggal_pinjam', date('Y'))->get();
            $chartValues = [];
            for ($i = 1; $i <= 12; $i++) {
                $chartValues[] = $peminjamanYear->filter(function($p) use ($i) {
                    return \Carbon\Carbon::parse($p->tanggal_pinjam)->month == $i;
                })->count();
            }

            return view('admin.dashboard', compact('chartValues'));
        }

        return view('user.dashboard');
    }
}
