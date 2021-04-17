<?php

namespace Roberts\Leads;

use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\LeadForm;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Models\LeadField;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Nova\LeadField as LeadFieldResource;
use Roberts\Leads\Nova\LeadStep as LeadStepResource;
use Roberts\Leads\Nova\LeadType as LeadTypeResource;
use Roberts\Leads\Policies\LeadPolicy;
use Roberts\Leads\Policies\LeadBusinessPolicy;
use Roberts\Leads\Policies\LeadFieldPolicy;
use Roberts\Leads\Policies\LeadStepPolicy;
use Roberts\Leads\Policies\LeadTypePolicy;
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
            ->hasPolicies([
                Lead::class => LeadPolicy::class,
                LeadBusiness::class => LeadBusinessPolicy::class,
                LeadField::class => LeadFieldPolicy::class,
                LeadStep::class => LeadStepPolicy::class,
                LeadType::class => LeadTypePolicy::class,
            ])
            ->hasNovaResources([
                LeadFieldResource::class,
                LeadStepResource::class,
                LeadTypeResource::class,
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
