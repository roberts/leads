<?php

namespace Roberts\WorkCompLeads\Livewire\OnboardingForm;

use Roberts\WorkCompLeads\Enums\OnboardingFormStep;

class PayrollClassifications extends OnboardingFormStepComponent
{
    protected $rules = [
        'attributes.class_code' => 'required',
        'attributes.number_of_employees' => 'required',
        'attributes.annual_payroll' => 'required',
    ];

    protected $validationAttributes = [];

    public function render()
    {
        return view('livewire.onboarding-form.payroll-classifications');
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
