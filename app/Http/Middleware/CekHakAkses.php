<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\HakAkses;

class CekHakAkses
{
    public function handle(Request $request, Closure $next, $modul, $aksi)
    {
        // Cek sudah login
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil role dari kolom users.role (bukan session saja)
        $role = auth()->user()->role ?? session('role');

        if (!$role) {
            return redirect('/login')->with('error', 'Role tidak ditemukan.');
        }

        // Operator bisa akses semua
        if ($role === 'Operator') {
            return $next($request);
        }

        // Cek tabel hak_akses
        $hak = HakAkses::where('role', $role)
                        ->where('modul', $modul)
                        ->first();

        if (!$hak || !$hak->{'can_' . $aksi}) {
            return redirect()->back()->with('error', 'Akses ditolak. Role ' . $role . ' tidak punya izin ' . $aksi . ' pada modul ' . $modul . '.');
        }

        return $next($request);
    }
}
