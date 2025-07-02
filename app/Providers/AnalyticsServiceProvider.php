<?php

namespace App\Providers;

// --- PASTIKAN BAGIAN 'USE' INI TERSALIN DENGAN BENAR ---
// Perhatikan penggunaan backslash (\) bukan titik (.).
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
// ---------------------------------------------------------

class AnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Menggunakan View Composer untuk membagikan data ke semua view.
        // Ini memastikan variabel $visitorStats tersedia di layout utama (app.blade.php).
        View::composer('*', function ($view) {
            
            // Cek dulu apakah Property ID sudah diatur di file .env
            // untuk menghindari error jika belum di-setting.
            if (!config('analytics.property_id')) {
                // Jika belum di-setting, kirim data default agar tidak error.
                $stats = ['online' => 0, 'today' => 0, 'total' => 0];
            } else {
                // Gunakan cache untuk menyimpan hasil dari API Google selama 30 menit.
                // Ini sangat penting untuk meningkatkan kecepatan website dan
                // menghindari pemanggilan API yang berlebihan setiap kali halaman dimuat.
                $stats = Cache::remember('analytics_stats', now()->addMinutes(30), function () {
                    try {
                        // Tentukan tanggal website Anda mulai dilacak oleh Google Analytics.
                        // PENTING: Ganti tanggal di bawah ini sesuai dengan kapan Anda
                        // pertama kali memasang kode pelacakan Google Analytics.
                        $startDate = Carbon::create(2024, 6, 30); 

                        return [
                            'online' => Analytics::fetchActiveUsers()->first()['activeUsers'] ?? 0,
                            'today'  => Analytics::fetchTotalUsersAndSessions(Period::days(1))->first()['totalUsers'] ?? 0,
                            'total'  => Analytics::fetchTotalUsersAndSessions(Period::create($startDate, now()))->first()['totalUsers'] ?? 0,
                        ];
                    } catch (\Exception $e) {
                        // Jika terjadi error saat mengambil data dari API (misal: masalah koneksi, izin, dll.)
                        // kita akan mencatat errornya ke dalam file log Laravel dan mengembalikan
                        // nilai default agar website tidak rusak atau menampilkan pesan error.
                        Log::error('Gagal mengambil data dari Google Analytics: ' . $e->getMessage());
                        return [
                            'online' => 0,
                            'today'  => 0,
                            'total'  => 0,
                        ];
                    }
                });
            }

            // Kirim variabel $visitorStats ke semua view yang ada.
            $view->with('visitorStats', $stats);
        });
    }
}
