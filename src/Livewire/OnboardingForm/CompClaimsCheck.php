<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class CompClaimsCheck extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.should_add_claims' => 'required|boolean',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.comp-claims-check');
    }

    public function processLead(array $data)
    {
        return $this->lead;
    }

    public function getNextStep()
    {
        if (! $this->attributes['should_add_claims']) {
            return OnboardingFormStep::COMPLETED;
        }

        return OnboardingFormStep::COMP_CLAIMS;
    }
}
