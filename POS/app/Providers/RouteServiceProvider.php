<?php

namespace App\Providers;

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
    }
}
