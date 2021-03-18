<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;
use Roberts\WorkCompLeads\Models\WcBusiness;
use Roberts\WorkCompLeads\Models\WcLead;

class Presentation extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.email' => 'required|email',
        'attributes.business.name' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.presentation');
    }

    public function processLead(array $data)
    {
        $business = WcBusiness::create($data['business']);

        return WcLead::create([
            'email' => $data['email'],
            'wc_business_id' => $business->id,
        ]);
    }

    public function getNextStep()
    {
        return OnboardingFormStep::CONTACT_DETAILS;
    }
}
