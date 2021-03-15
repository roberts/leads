<?php

namespace App\Http\Livewire\OnboardingForm;

use App\Enums\OnboardingFormStep;

class Presentation extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.email' => 'required|email',
        'attributes.business.name' => 'required',
    ];

    public function render()
    {
        return view('livewire.onboarding-form.presentation');
    }

    public function processLead(array $data)
    {
        return WcLead::factory()->create();
    }

    public function getNextStep()
    {
        return OnboardingFormStep::CONTACT_DETAILS;
    }
}
