<?php

namespace App\Providers;

use Livewire\Livewire;
use App\Livewire\ItemReview;
use App\Livewire\SearchModal;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('item-review', ItemReview::class);
        Livewire::component('search-modal', SearchModal::class);
    }
}
