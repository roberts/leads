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
    public function configureTipoffPackage(TipoffPackage $tipoffPackage): void
    {
        $tipoffPackage
            ->hasWebRoute('web')
            ->hasAssets()
            ->hasViews()
            ->name('leads')
            ->hasConfigFile();
    }
    
    public function bootingPackage()
    {
        parent::bootingPackage();

        $this->registerLivewireComponents();
    }

    public function registeringPackage()
    {
        parent::registeringPackage();

        $this->app->bind(GenerateLeadNumber::class, GenerateLeadNumberBasedOnTime::class);
        $this->app->bind(SaveLead::class, SaveLeadFromDottedAttributes::class);
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('lead-form', LeadForm::class);
    }
}
