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
        $data_peminjaman = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        } else {
        // Anggota cuma bisa lihat punya dia sendiri
        $data_peminjaman = Peminjaman::where('anggota_id', Auth::id())
                                    ->with(['anggota', 'buku'])
                                    ->latest()
                                    ->get();
    }

    return view('peminjaman.index', compact('data_peminjaman'));
        // Ambil data peminjaman beserta nama anggota dan judul buku (Eager Loading)
        // latest() digunakan agar data terbaru muncul paling atas
        $data_peminjaman = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        return view('peminjaman.index', compact('data_peminjaman'));
    }

    public function create()
    {
        $data_anggota = Anggota::all();
        // Canggih nih: Hanya tampilkan buku yang stoknya lebih dari 0!
        $data_buku = Buku::where('stok', '>', 0)->get(); 
        
        return view('peminjaman.create', compact('data_anggota', 'data_buku'));
    }

    // Di dalam fungsi store:
    public function store(Request $request)
    {
        // Jika user adalah anggota, pakai ID dia sendiri
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
                'anggota_id' => $anggota_id, // Pakai ID yang sudah ditentukan
                'buku_id' => $request->buku_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'dipinjam',
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dipinjam!');
    }

        public function cetakPDF()
    {
        // Ambil semua data peminjaman beserta relasi buku dan anggotanya
        $peminjaman = Peminjaman::with(['buku', 'anggota'])->get();
        
        // Kirim data ke file tampilan khusus PDF
        $pdf = Pdf::loadView('peminjaman.pdf', compact('peminjaman'));
        
        // Tampilkan hasilnya di browser (kalau mau langsung ter-download, ganti stream() jadi download())
        return $pdf->stream('Laporan-Peminjaman-HiPerpus.pdf');
    }

}