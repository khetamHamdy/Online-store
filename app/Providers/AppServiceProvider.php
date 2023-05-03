<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Chat;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Language;
use App\Models\Order;
use App\Models\User;
use Illuminate\Pagination\Paginator;

use Auth;


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
        //  Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view)
        {


            //...with this variable
            $view->with([
                'setting' => Setting::query()->first(),
                'locales'=> Language::all(),
                'admin'=>Admin::first(),
                'contact'=> Contact::where('is_read',0)->count(),
                'count_orders'=> 1,
                'count_categories'=> 5,
              //  'users_count'=>User::count(),

            ]);
        });
    }
}
