<?php

namespace App\Http\Livewire\OnboardingForm;

use App\Enums\OnboardingFormStep;

class CompClaims extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.past_comp_claims' => 'required',
    ];

    public function render()
    {
        return view('livewire.onboarding-form.comp-claims');
    }

    public function processLead(array $data)
    {
        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::COMPLETED;
    }
}
