<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Kecamatan;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        // Data untuk Kabupaten Subang
        Kecamatan::updateOrCreate(
            ['slug' => 'kabupaten-subang'],
            [
                'name' => 'Kabupaten Subang',
                'logo' => 'path/to/logo_kabupaten.png',
                'peta_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253708.07451633332!2d107.56092039399837!3d-6.497783201719495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693e8d5e81b635%3A0x301e8f1fc28b940!2sKabupaten%20Subang%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1751340469152!5m2!1sid!2sid',
            ]
        );

        // Data semua kecamatan
        $data = [
            'Binong', 'Blanakan', 'Ciasem', 'Ciater', 'Cibogo',
            'Cijambe', 'Cikaum', 'Cipeundeuy', 'Compreng', 'Dawuan',
            'Jalancagak', 'Kalijati', 'Kasomalang', 'Legonkulon', 'Pagaden',
            'Pagaden Barat', 'Pamanukan', 'Patokbeusi', 'Purwadadi', 'Pusakajaya',
            'Pusakanagara', 'Sagalaherang', 'Serangpanjang', 'Subang', 'Sukasari',
            'Tambakdahan', 'Tanjungsiang', 'Cipunagara', 'Cisalak'
        ];

        foreach ($data as $nama) {
            $slug = Str::slug($nama);

            // Gunakan embed map khusus untuk Binong, default lainnya pakai query map
            $petaUrl = $slug === 'binong'
                ? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63439.183889370775!2d107.75510941810248!3d-6.400574161527868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69471057b36019%3A0xf241f0047a70576c!2sKec.%20Binong%2C%20Kabupaten%20Subang%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1751338385653!5m2!1sid!2sid'
                : 'https://www.google.com/maps?q=' . urlencode($nama . ', Kabupaten Subang') . '&output=embed';

            Kecamatan::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $nama,
                    'logo' => 'path/to/logo_' . $slug . '.png',
                    'peta_url' => $petaUrl,
                ]
            );
        }
    }
}
