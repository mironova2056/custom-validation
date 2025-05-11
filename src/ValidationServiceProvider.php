<?php

namespace CustomValidation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('custom-validator', function ($app) {
            return new Validator();
        });
    }
}