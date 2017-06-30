<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Auth;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function($view){ // * asteric is  a wild card representing all views i.e  the function should work on all views on the entire application 
            if (Auth::user()) {
                $view->with('current_user_role', Auth::user()->role_id);
                if (isset($current_user_image)) {
                    $view->with('current_user_image', Auth::user()->user_image);
                }
                if (Auth::user()->role_id === 1) {
                    // echo "<script> alert('welcome admin') </script>";
                     $users = User::where('role_id', '!===', 1)->Paginate(5);
                     $view->with('users', $users); //dis guy will appear on every page of the application no need of saying something like  return view(users.view_request)
                }else{
                    
                }
            }
        });

        // view()->composer('partials.header', function($view){ //wen laravel is composing the view we named called partials.header den pass tru the $view object here
        //     if (Auth::user()) {
        //         $view->with('current_user_role', Auth::user()->role_id);
        //     }
        // });

        // view()->composer(['partials.header','users.view_request','users.edit'], function($view){ //wen laravel is composing the view we named called partials.header den pass tru the $view object here
        //     if (Auth::user()) {
        //         $view->with('current_user_role', Auth::user()->role_id);
        //     }
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
