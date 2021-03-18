<?php

namespace Roberts\Leads\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;
use Roberts\Leads\Models\WcBusiness;
use Roberts\Leads\Models\WcLead;

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
