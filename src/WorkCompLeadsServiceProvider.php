<?php

namespace Roberts\WorkCompLeads;

use Livewire\Livewire;
use Roberts\WorkCompLeads\Livewire\OnboardingForm;
use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class WorkCompLeadsServiceProvider extends TipoffServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->registerLivewireComponents();
    }

    public function configureTipoffPackage(TipoffPackage $tipoffPackage): void
    {
        $tipoffPackage
            ->name('work-comp-leads')
            ->hasConfigFile()
            ->hasWebRoute('web')
            ->hasViews()
            ->hasAssets();
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('onboarding-form', OnboardingForm::class);
        Livewire::component('presentation', OnboardingForm\Presentation::class);
        Livewire::component('contact-details', OnboardingForm\ContactDetails::class);
        Livewire::component('mailing-address', OnboardingForm\MailingAddress::class);
        Livewire::component('business-details', OnboardingForm\BusinessDetails::class);
        Livewire::component('payroll-classifications', OnboardingForm\PayrollClassifications::class);
        Livewire::component('comp-insurance-check', OnboardingForm\CompInsuranceCheck::class);
        Livewire::component('comp-insurance', OnboardingForm\CompInsurance::class);
        Livewire::component('comp-claims-check', OnboardingForm\CompClaimsCheck::class);
        Livewire::component('comp-claims', OnboardingForm\CompClaims::class);
        Livewire::component('completed', OnboardingForm\Completed::class);
    }
}
