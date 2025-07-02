<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDaerah extends Model
{
    use HasFactory;

    protected $table = 'Perangkatdaerah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kecamatan_id',
        'nama_desa',
        'kepala_desa',
        'luas_wilayah',
        'jumlah_penduduk',
        'keterangan',
    ];

    /**
     * Mendapatkan data kecamatan yang memiliki desa ini.
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
