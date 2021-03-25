<?php

namespace Roberts\Leads\Http\Livewire\OnboardingForm;

use Livewire\Component;

abstract class OnboardingFormStepComponent extends Component
{
    public $lead;
    public $attributes;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $data = $this->validate();

        $this->lead = $this->processLead($data['attributes']);

        $this->emit('completed', $this->getNextStep());
        $this->emit('lead-updated', $this->lead->id);
    }

    abstract public function processLead(array $data);

    abstract public function getNextStep();
}
