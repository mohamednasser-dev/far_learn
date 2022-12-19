<?php

namespace App\Providers;

use App\Models\Web_setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ob_start();
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Riyadh');
        Paginator::viewFactory();
        //to save lang api to app language ....
        $languages = ['ar', 'en'];
        $lang = request()->header('lang');
        if ($lang) {
            if (in_array($lang, $languages)) {
                App::setLocale($lang);
            } else {
                App::setLocale('ar');
            }
        }
        //End : save lang api to app language ...
        if (Schema::hasTable('web_settings')) {
            View::share('settings_share', Web_setting::orderBy('id', 'desc')->first());
        }
    }
}
