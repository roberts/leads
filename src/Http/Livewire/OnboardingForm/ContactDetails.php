<?php

namespace Roberts\Leads\Http\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;
use Roberts\Leads\Http\Livewire\OnboardingForm\OnboardingFormStepComponent;

class ContactDetails extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.first_name' => 'required',
        'attributes.last_name' => 'required',
        'attributes.position' => 'required',
        'attributes.phone_number' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.contact-details');
    }

    public function processLead(array $data)
    {
        $this->lead->update($data);

        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::MAILING_ADDRESS;
    }
}
