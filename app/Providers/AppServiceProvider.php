<?php

namespace App\Providers;

use App\Models\JenisProdukHukum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


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
    public function boot(): void
    {
        View::composer('layouts.partial.sidebar-guest', function ($view) {
            $listMenuJenis = collect();

            if (Schema::hasTable('jenis_produk_hukum')) {
                // Langsung ambil semua dan urutkan berdasarkan nama A-Z
                $listMenuJenis = JenisProdukHukum::orderBy('nama', 'asc')->get();
            }

            $view->with('listMenuJenis', $listMenuJenis);
        });
    }
}
