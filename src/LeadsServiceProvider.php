<?php

namespace Roberts\Leads;

use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\LeadForm;
use Roberts\Leads\Services\GenerateLeadNumber;
use Roberts\Leads\Services\GenerateLeadNumberBasedOnTime;
use Roberts\Leads\Services\SaveLead;
use Roberts\Leads\Services\SaveLeadFromDottedAttributes;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class LeadsServiceProvider extends TipoffServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->registerLivewireComponents();
    }

    public function register()
    {
        parent::register();

        $this->app->bind(GenerateLeadNumber::class, GenerateLeadNumberBasedOnTime::class);
        $this->app->bind(SaveLead::class, SaveLeadFromDottedAttributes::class);
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
