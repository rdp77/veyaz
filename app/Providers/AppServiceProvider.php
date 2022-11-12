<?php

namespace App\Providers;

use App\Models\Core\Settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        // Register Telescope services
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // HTTPS Force Redirect
        if (App::environment() !== 'local') {
            URL::forceScheme('https');
        }
//        // Share data with all views
//        View::share([
//            'title' => Settings::where('name', 'Title')->first()->value ?? config('veyaz.title'),
//            'short_title' => Settings::where('name', 'Short Title')->first()->value ?? config('veyaz.short_title'),
//            'description' => Settings::where('name', 'Description')->first()->value ?? config('veyaz.description'),
//            'logo' => Settings::where('name', 'Logo')->first()->value ?? config('veyaz.logo'),
//            'default_photo_profile' => Settings::where('name', 'Default Photo Profile')->first()->value ?? config('veyaz.default_photo_profile'),
//        ]);
    }
}
