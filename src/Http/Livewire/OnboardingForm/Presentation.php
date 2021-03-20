<?php

namespace Roberts\Leads\Http\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;
use Roberts\Leads\Http\Livewire\OnboardingForm\OnboardingFormStepComponent;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;

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
        $business = LeadBusiness::create($data['business']);

        return Lead::create([
            'email' => $data['email'],
            'lead_business_id' => $business->id,
        ]);
    }

    public function getNextStep()
    {
        return OnboardingFormStep::CONTACT_DETAILS;
    }
}
