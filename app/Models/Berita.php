<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_berita_id',
        'kecamatan_id', // <-- pastikan ini ditambahkan agar mass assignment bisa dilakukan
        'judul',
        'slug',
        'excerpt',
        'isi',
        'published_at',
    ];

    // Relasi: Berita milik satu KategoriBerita
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    // Relasi: Berita milik satu Kecamatan (opsional untuk berita kabupaten)
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
