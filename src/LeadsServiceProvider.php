<?php

namespace Roberts\Leads;

use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\LeadForm;
use Roberts\Leads\Nova\LeadField;
use Roberts\Leads\Nova\LeadStep;
use Roberts\Leads\Nova\LeadType;
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
            ->hasNovaResources([
                LeadField::class,
                LeadStep::class,
                LeadType::class,
            ])
            ->hasWebRoute('web')
            ->hasViews()
            ->name('leads')
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        parent::bootingPackage();

        $this->publishStyles();

        $this->registerLivewireComponents();
    }

    public function registeringPackage()
    {
        parent::registeringPackage();

        $this->app->bind(GenerateLeadNumber::class, GenerateLeadNumberBasedOnTime::class);
        $this->app->bind(SaveLead::class, SaveLeadFromDottedAttributes::class);
    }

    public function publishStyles()
    {
        $this->publishes([
            __DIR__.'/../resources/scss/' => resource_path('scss/vendor/leads'),
        ], 'styles');
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('lead-form', LeadForm::class);
    }
}
