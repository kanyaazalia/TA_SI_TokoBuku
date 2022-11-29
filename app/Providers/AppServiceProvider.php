<?php

namespace App\Providers;

use App\Models\ActivatedKaryawan;
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
        Gate::define('admin', function (ActivatedKaryawan $karyawan){
            return $karyawan->admin >= 1;
        });

        Gate::define('user', function (ActivatedKaryawan $karyawan){
            return $karyawan->admin >= 0;
        });
    }
}
