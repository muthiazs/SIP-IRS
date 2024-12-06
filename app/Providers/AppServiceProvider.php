<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $currentDate = Carbon::now();
    
            // Dapatkan periode akademik terbaru
            $periodeTerbaru = DB::table('periode_akademik')
                ->orderBy('id_periode', 'DESC') // Ambil periode akademik berdasarkan id_periode terbaru
                ->first();
    
            // Jika periode terbaru ditemukan, cari kegiatan terkait IRS untuk periode tersebut
            if ($periodeTerbaru) {
                // Cek kegiatan IRS untuk periode tersebut
                $masaPeriode = DB::table('kalender_akademik')
                    ->join('periode_akademik', 'periode_akademik.id_periode', '=', 'kalender_akademik.id_periode')
                    ->select('kalender_akademik.kode_kegiatan')
                    ->where('kalender_akademik.id_periode', $periodeTerbaru->id_periode) // Pastikan periode terbaru digunakan
                    ->whereDate('tanggal_mulai', '<=', $currentDate) // Cek tanggal mulai
                    ->whereDate('tanggal_selesai', '>=', $currentDate) // Cek tanggal selesai
                    ->whereIn('kalender_akademik.kode_kegiatan', ['isiIRS', 'gantiIRS', 'batalIRS']) // Cek kegiatan IRS
                    ->first();
    
                // Berikan kode kegiatan IRS jika ditemukan, jika tidak null
                $view->with('masaIRS', $masaPeriode ? $masaPeriode->kode_kegiatan : null);
            } else {
                // Jika tidak ada periode akademik, set null
                $view->with('masaIRS', null);
            }
        });
    }
}
