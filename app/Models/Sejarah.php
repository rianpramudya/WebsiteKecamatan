<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sejarah extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'sejarahs';

    protected $fillable = [
        'kecamatan_id',
        'tahun',
        'judul',
        'deskripsi',
        'urutan',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
