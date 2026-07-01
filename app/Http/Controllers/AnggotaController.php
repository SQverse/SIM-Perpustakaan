<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {
        $data_anggota = Anggota::all();
        return view('anggota.index', compact('data_anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|unique:anggotas,nomor_anggota|max:20',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);
    
    Anggota::create([
        'nomor_anggota'=> $request->nomor_anggota,
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat
    ]);
    
    return redirect()->route('anggota.index');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi: Nomor anggota boleh sama HANYA dengan nomor dia sendiri (biar bisa di-save kalau gak diganti)
            'nomor_anggota' => 'required|max:20|unique:anggotas,nomor_anggota,'.$id,
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'nomor_anggota' => $request->nomor_anggota,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('anggota.index');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index');
    }
}

