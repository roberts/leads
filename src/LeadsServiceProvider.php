<?php

namespace Roberts\Leads;

use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\LeadForm;
use Roberts\Leads\Http\Livewire\OnboardingForm;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class LeadsServiceProvider extends TipoffServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'leads');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->registerLivewireComponents();
    }

    public function configureTipoffPackage(TipoffPackage $tipoffPackage): void
    {
        $tipoffPackage
            ->name('leads')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets();
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('lead-form', LeadForm::class);
    }
}
