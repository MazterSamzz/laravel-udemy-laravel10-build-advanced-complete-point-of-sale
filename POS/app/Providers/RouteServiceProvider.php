<?php

namespace App\Providers;

use App\Models\Backend\Permission;
use App\Models\Backend\Sale;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Custom route binding untuk Sale model
        Route::bind('sale', function ($id) {
            try {
                // Mencoba mendekripsi ID
                $decryptId = Crypt::decryptString($id);
                // Cari Sale dengan ID yang sudah didekripsi
                return Sale::findOrFail($decryptId);
            } catch (\Exception $e) {
                // Jika dekripsi gagal, atau Sale tidak ditemukan, redirect ke index
                return redirect()->route('sales.index')->with([
                    'messages' => 'Invalid sales id',
                    'type' => 'danger'
                ]);
            }
        });

        // Custom route binding untuk Permission model
        Route::bind('permission', function ($id) {
            try {
                // Mencoba mendekripsi ID
                $decryptId = Crypt::decryptString($id);
                // Cari Permission dengan ID yang sudah didekripsi
                return Permission::findOrFail($decryptId);
            } catch (\Exception $e) {
                // Jika dekripsi gagal, atau Permission tidak ditemukan, redirect ke index
                return redirect()->route('permission.index')->with([
                    'messages' => 'Invalid permisson id',
                    'type' => 'danger'
                ]);
            }
        });
    }
}
