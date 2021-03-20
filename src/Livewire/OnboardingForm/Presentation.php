<?php

namespace Roberts\Leads\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;

class Presentation extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.email' => 'required|email',
        'attributes.business_name' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.presentation');
    }

    public function processLead(array $data)
    {
        $lead = Lead::create([
            'email' => $data['email'],
        ]);

        LeadBusiness::create([
            'name' => $data['business_name'],
            'lead_id' => $lead->id,
        ]);

        return $lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::CONTACT_DETAILS;
    }
}
