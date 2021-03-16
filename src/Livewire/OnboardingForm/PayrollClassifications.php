<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class PayrollClassifications extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.class_code' => 'required',
        'attributes.number_of_employees' => 'required|integer',
        'attributes.annual_payroll' => 'required|numeric',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('sl::livewire.onboarding-form.payroll-classifications');
    }

    public function processLead(array $data)
    {
        return $this->lead;
    }

    public function getNextStep()
    {
        return OnboardingFormStep::COMP_INSURANCE_CHECK;
    }
}
