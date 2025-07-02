<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeranDanProgram extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kecamatan_id',
        'judul',
        'deskripsi',
        'urutan',
    ];

    /**
     * Mendapatkan data kecamatan yang memiliki peran/program ini.
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
