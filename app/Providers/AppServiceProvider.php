<?php

namespace App\Providers;

use Filament\Forms\Components\DatePicker;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
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
        DatePicker::configureUsing(function (DatePicker $datepicker) {
            $datepicker
                ->prefixIcon('heroicon-o-calendar')
                ->placeholder('dd mmm YYYY')
                ->displayFormat('d M Y')
                ->native(false)
                ->closeOnDateSelection(true);
        });

        FilamentAsset::register([
            Css::make('custom', __DIR__ . '/../../resources/css/custom.css'),
        ]);
    }
}
