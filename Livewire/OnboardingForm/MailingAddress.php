<?php

namespace App\Http\Livewire\OnboardingForm;

use App\Enums\OnboardingFormStep;

class MailingAddress extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.zip_code' => 'required',
        'attributes.mailing_address' => 'required',
        'attributes.city' => 'required',
        'attributes.state' => 'required',
    ];

    public function render()
    {
        return view('livewire.onboarding-form.mailing-address');
    }

    public function processLead(array $data)
    {
        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::BUSINESS_DETAILS;
    }
}
