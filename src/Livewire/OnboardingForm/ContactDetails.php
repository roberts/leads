<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class ContactDetails extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.first_name' => 'required',
        'attributes.last_name' => 'required',
        'attributes.position' => 'required',
        'attributes.phone_number' => 'required',
    ];

    public function render()
    {
        return view('livewire.onboarding-form.contact-details');
    }

    public function processLead(array $data)
    {
        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::MAILING_ADDRESS;
    }
}
