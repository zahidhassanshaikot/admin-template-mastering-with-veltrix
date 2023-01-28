<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Robiussani152\Settings\Models\Settings;

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
        try {
            Schema::defaultStringLength(191);
            $settings =Settings::all([
                'setting_key', 'setting_value'
            ])->keyBy('setting_key')
                ->transform(function ($setting) {
                    return $setting->setting_value;
                })
                ->toArray();
            config([
                'settings' => $settings
            ]);
            if(config('settings.timezone') != null){
                config([
                    'app.timezone' => config('settings.timezone')
                ]);
            }
        }catch (\Exception $exception){
            Log::debug('App service provider boot method config error: =>'.$exception->getMessage());
        }
    }
}
