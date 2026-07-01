<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;       // Panggil Model Buku
use App\Models\Kategori;   // Panggil Model Kategori

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query pemanggilan buku beserta relasi kategorinya
        $query = Buku::with('kategori');

        // 1. Fitur PENCARIAN (berdasarkan Judul atau Pengarang)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                ->orWhere('pengarang', 'like', '%' . $search . '%');
            });
        }

        // 2. Fitur FILTER (berdasarkan Kategori)
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Eksekusi query dan ambil data kategori untuk dropdown filter
        $data_buku = $query->latest()->get();
        $data_kategori = Kategori::all();

        return view('buku.index', compact('data_buku', 'data_kategori'));
    }
    
    public function create()
    {
        // Kita butuh mengambil semua data kategori untuk memunculkan pilihan di dropdown form
        $data_kategori = Kategori::all();
        return view('buku.create', compact('data_kategori'));
    }

    public function store(Request $request)
    {
        // Validasi data inputan
        $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id', // Pastikan ID kategorinya ada di database
            'stok' => 'required|integer|min:0',
            'tahun_terbit' => 'required|digits:4',
        ]);

        // Simpan data ke database
        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        return redirect()->route('buku.index');
    }
}