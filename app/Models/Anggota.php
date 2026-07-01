<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'nomor_anggota',
        'nama',
        'no_hp',
        'alamat'
    ];
}
