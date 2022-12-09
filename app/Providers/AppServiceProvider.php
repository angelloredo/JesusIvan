<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Event;
use App\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\GeneralSettings;
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
        Schema::defaultStringLength(191);
        $_ENV['admin'] = 'admin';
        try {
            DB::connection()->getPdo();

            $data['basic'] = GeneralSettings::first();
            $_ENV['admin'] = $data['basic']->prefix;
            $data['tournaments'] = Event::where('status', 1)->get();


            $languagesStr = '';
            Language::orderBy('name')->where('is_active', 1)->get()->map(function ($item) use (&$languagesStr) {
                $languagesStr .= '"' . strtoupper($item->short_name) . '":"' . trim($item->name) . '",';
                return $languagesStr;
            });

            $data['languages'] = flagLanguage($languagesStr);
            view()->share($data);
        }catch (\Exception $e){

        }
    }
}
