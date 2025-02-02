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
                // Share sidebar background color globally with all views
    view()->composer('*', function ($view) {
        // Get the current authenticated user
        $user = auth()->user();
        
        // Retrieve the color from the user model (or elsewhere in your application)
        $sidebarBgColor = $user ? $user->sidebar_bg_color : 'bg-gray-800'; // Default color
        $headerBgColor = $user ? $user->header_bg_color : 'bg-gray-800'; // Default color
        $textColor = $user ? $user->text_color : 'bg-gray-800'; // Default color

        // Share the color with all views
        $view->with('sidebarBgColor', $sidebarBgColor)->with('headerBgColor', $headerBgColor)->with('textColor', $textColor);
    });
    }
}
