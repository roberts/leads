<?php

namespace App\Http\Livewire;

use App\Enums\OnboardingFormStep;
use App\Models\WcLead;
use Livewire\Component;

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
        return view('livewire.onboarding-form');
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

    public function setLead(WcLead $lead)
    {
        $this->lead = $lead;
    }
}