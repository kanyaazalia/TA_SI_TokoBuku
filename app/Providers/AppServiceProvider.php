<?php

namespace App\Providers;

use App\Models\Karyawan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Gate untuk identifikasi admin atau user di resource controller
        Gate::define('admin', function (Karyawan $karyawan){
            return $karyawan->admin >= 1;
        });

        Gate::define('user', function (Karyawan $karyawan){
            return $karyawan->admin >= 0;
        });
    }
}
