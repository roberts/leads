<?php

namespace Roberts\Leads\Http\Livewire;

use Livewire\Component;
use Roberts\Leads\Enums\OnboardingFormStep;
use Roberts\Leads\Models\Lead;

class OnboardingForm extends Component
{
    public $lead;
    public $step;

    protected $listeners = [
        'lead-updated' => 'setLead',
        'completed' => 'proceed',
    ];

    protected $queryString = [
        'step',
    ];

    public function render()
    {
        return view('leads::livewire.onboarding-form');
    }

    public function mount()
    {
        if (empty(request()->query('step'))) {
            $this->step = OnboardingFormStep::PRESENTATION;
        }
    }

    public function proceed(string $step)
    {
        $this->step = $step;
    }

    public function setLead(Lead $lead)
    {
        $this->lead = $lead;
    }
}
