<?php

namespace Roberts\Leads;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class LeadsServiceProvider extends TipoffServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'leads');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    public function configureTipoffPackage(TipoffPackage $tipoffPackage): void
    {
        $tipoffPackage
            ->name('leads')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets();
    }
}
