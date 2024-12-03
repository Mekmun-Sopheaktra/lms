<?php

namespace App\Providers;

use App\Repositories\SettingRepository;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $setting = SettingRepository::query()->get()->first();

            $data = [
                'name' => config('app.name'),
                'currency' => config('app.currency'),
                'currency_symbol' => config('app.currency_symbol'),
                'logo' => $setting->logoPath,
                'favicon' => $setting->faviconPath,
                'footer_text' => $setting->footer_text,
                'timezone' => config('app.timezone'),
                'currency_position' => $setting->currency_position,
            ];

            $view->with('app_setting', $data);
        });
    }
}
