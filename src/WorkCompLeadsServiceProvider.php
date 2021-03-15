<?php

declare(strict_types=1);

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

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'wc');

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/work-comp-leads'),
        ], 'public');

        $this->registerLivewireComponents();
    }

    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('work-comp-leads')
            ->hasConfigFile();
    }

    protected function registerLivewireComponents()
    {
        Livewire::component('wc::onboarding-form', OnboardingForm::class);
    }
}
