<?php

namespace Roberts\Leads\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;

class CompClaims extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.past_comp_claims' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.comp-claims');
    }

    public function processLead(array $data)
    {
        $this->lead->business->update($data);

        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::COMPLETED;
    }
}
