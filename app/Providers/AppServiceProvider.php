<?php

namespace App\Providers;

// Deps
use App\Element;
use App\Services\CurrentSite;
use Bkwld\Decoy\Collections\Elements;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Use subclass of ELement
        $this->app->resolving('decoy.elements', function(Elements $elements) {
            $elements->setModel(new Element);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Manager for the current site
        $this->app->singleton('site', function() {
            return new CurrentSite;
        });
    }
}
