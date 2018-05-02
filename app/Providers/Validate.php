<?php

namespace App\Providers;

use App\Rules\ValidateDomainEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class Validate extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('email_domain', function ($attribute, $value, $parameters, $validator) {
            $emailDomain = explode('@', $value);
            $emailDomain = $emailDomain[1];
            $host = gethostbyname($emailDomain);
            if ($host == $emailDomain) {
                return false;
            } else {
                return true;
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
