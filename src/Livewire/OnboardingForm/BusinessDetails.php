<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class BusinessDetails extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.nature' => 'required',
        'attributes.legal_entity_type' => 'required',
        'attributes.fein' => 'required',
        'attributes.year_of_establishment' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('sl::livewire.onboarding-form.business-details');
    }

    public function processLead(array $data)
    {
        $this->lead->business->update($data);

        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::PAYROLL_CLASSIFICATIONS;
    }
}
