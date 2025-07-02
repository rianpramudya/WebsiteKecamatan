<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'peta_url',
        'sejarah',
        'arti_lambang',
        'sejarah_img_1',
        'sejarah_img_2',
        'sejarah_img_3',
    ];

    /**
     * PERUBAHAN UTAMA DI SINI:
     * Nama relasi diubah dari desas() menjadi perangkatDaerahs().
     * Ini mendefinisikan bahwa satu Kecamatan memiliki banyak PerangkatDaerah.
     */
    public function perangkatDaerahs()
    {
        // Laravel secara otomatis akan mencari model bernama PerangkatDaerah
        return $this->hasMany(PerangkatDaerah::class);
    }

     public function sejarahItems()
    {
        // Nama relasi diubah menjadi sejarahItems untuk menghindari konflik
        return $this->hasMany(Sejarah::class)->orderBy('urutan');
    }
}
