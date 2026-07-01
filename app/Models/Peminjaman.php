<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'anggota_id', 
        'buku_id', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
        'status'
    ];

    // 2. Relasi ke tabel Anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    // 3. Relasi ke tabel Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}