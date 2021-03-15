<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class CompInsurance extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.current_plan_under_cancellation' => 'required|boolean',
        'attributes.current_plan_expires_at' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('sl::livewire.onboarding-form.comp-insurance');
    }

    public function processLead(array $data)
    {
        $this->lead->update($data);

        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::COMP_CLAIMS_CHECK;
    }
}