<?php

namespace App\Providers;

use App\Models\Base;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    
    public function boot(): void
    {
        Schema::defaultStringLength(Base::DEFAULT_STRING_LENGTH);
        
        // Observers
        User::observe(UserObserver::class);
    }
}
