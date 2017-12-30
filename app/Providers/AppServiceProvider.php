<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
    		// Contain at least one uppercase/lowercase letters, one number and one special char
    		return preg_match('/^(?=.*?[a-zA-Z])(?=.*?[0-9])[\w@#$%^?~-]{1,}$/', (string)$value);
    	}, __('validation.strong_password'));
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
