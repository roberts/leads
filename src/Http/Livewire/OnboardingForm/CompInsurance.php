<?php

namespace Roberts\Leads\Http\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;

class CompInsurance extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.current_plan_under_cancellation' => 'required|boolean',
        'attributes.current_plan_expires_at' => 'required|date',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('leads::livewire.onboarding-form.comp-insurance');
    }

    public function processLead(array $data)
    {
        $this->lead->business->update($data);

        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::COMP_CLAIMS_CHECK;
    }
}
