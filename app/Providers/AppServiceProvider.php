<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

// use App\Models\Setting;

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
        view()->composer('*', function ($view) {
            $user = Auth::user();

            $sidebarBgColor = $user ? $user->sidebar_bg_color : 'bg-gray-800';
            $headerBgColor = $user ? $user->header_bg_color : 'bg-gray-800';
            $textColor = $user ? $user->text_color : 'text-gray-800';
            
            // Langsung ambil dari public/
            $backgroundImage = ($user && $user->background_image) 
                ? asset($user->background_image) 
                : asset('images/bg3.jpg'); // Default background

            $view->with([
                'sidebarBgColor' => $sidebarBgColor,
                'headerBgColor' => $headerBgColor,
                'textColor' => $textColor,
                'backgroundImage' => $backgroundImage
            ]);
        });
    }

}
