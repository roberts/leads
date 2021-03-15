<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class CompInsuranceCheck extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.has_comp_insurance' => 'required|boolean',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.comp-insurance-check');
    }

    public function processLead(array $data)
    {
        return $this->lead;
    }

    public function getNextStep()
    {
        if (! $this->attributes['has_comp_insurance']) {
            return OnboardingFormStep::COMPLETED;
        }

        return OnboardingFormStep::COMP_INSURANCE;
    }
}
