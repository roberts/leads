<?php

namespace Roberts\Leads\Http\Livewire\OnboardingForm;

use Roberts\Leads\Enums\OnboardingFormStep;
use Roberts\Leads\Http\Livewire\OnboardingForm\OnboardingFormStepComponent;

class BusinessDetails extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.nature' => 'required',
        'attributes.legal_entity_type' => 'required',
        'attributes.fein' => 'required',
        'attributes.year_of_establishment' => 'required|integer',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.business-details');
    }

    public function processLead(array $data)
    {
        $this->lead->business->update($data);

        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::COMP_INSURANCE_CHECK;
    }
}
