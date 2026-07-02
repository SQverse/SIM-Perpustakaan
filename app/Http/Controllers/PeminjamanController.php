<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;  
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth; 
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
public function index()
    {
        if (Auth::user()->role == 'admin') {
            // Admin melihat semua data
            $data_peminjaman = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        } else {
            // Anggota difilter langsung pakai ID-nya, tanpa ngecek kolom user_id yang gaib itu
            $data_peminjaman = Peminjaman::where('anggota_id', Auth::id())
                                        ->with(['anggota', 'buku'])
                                        ->latest()
                                        ->get();
        }

        return view('peminjaman.index', compact('data_peminjaman'));
    }
    
    public function create()
    {
        $data_anggota = Anggota::all();
        $data_buku = Buku::where('stok', '>', 0)->get(); 
        
        return view('peminjaman.create', compact('data_anggota', 'data_buku'));
    }

    public function store(Request $request)
    {
        // Logika: Jika Admin, ambil dari input form. Jika Anggota, pakai ID dia sendiri
        $anggota_id = (Auth::user()->role == 'admin') ? $request->anggota_id : Auth::id();

        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        
        if ($buku->stok > 0) {
            $buku->decrement('stok');

            Peminjaman::create([
                'anggota_id' => $anggota_id,
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'dipinjam',
            ]);
            
            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dipinjam!');
        }

        return back()->with('error', 'Stok buku habis!');
    }

    public function cetakPDF()
    {
        // Cetak laporan hanya untuk admin (bisa tambah validasi middleware jika perlu)
        $peminjaman = Peminjaman::with(['buku', 'anggota'])->get();
        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjaman'));
        
        return $pdf->stream('Laporan-Peminjaman-HiPerpus.pdf');
    }
}