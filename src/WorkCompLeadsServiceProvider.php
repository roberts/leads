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
            ->hasViews()
            ->hasAssets();
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('wc::onboarding-form', OnboardingForm::class);
        Livewire::component('wc::presentation', OnboardingForm\Presentation::class);
        Livewire::component('wc::contact-details', OnboardingForm\ContactDetails::class);
        Livewire::component('wc::mailing-address', OnboardingForm\MailingAddress::class);
        Livewire::component('wc::business-details', OnboardingForm\BusinessDetails::class);
        Livewire::component('wc::payroll-classifications', OnboardingForm\PayrollClassifications::class);
        Livewire::component('wc::comp-insurance-check', OnboardingForm\CompInsuranceCheck::class);
        Livewire::component('wc::comp-insurance', OnboardingForm\CompInsurance::class);
        Livewire::component('wc::comp-claims-check', OnboardingForm\CompClaimsCheck::class);
        Livewire::component('wc::comp-claims', OnboardingForm\CompClaims::class);
        Livewire::component('wc::completed', OnboardingForm\Completed::class);
    }
}
