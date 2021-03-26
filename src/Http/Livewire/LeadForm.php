<?php

namespace Roberts\Leads\Http\Livewire;

use Livewire\Component;
use Roberts\Leads\Models\LeadType;

class LeadForm extends Component
{
    public $leadType;
    public $step;
    protected $queryString = ['step'];

    public function mount(LeadType $leadType)
    {
        $this->leadType = $leadType;

        if (empty($this->step)) {
            $this->step = $this->leadType->initialStep->slug;
        }
    }

    public function render()
    {
        return view('leads::livewire.lead-form')
            ->layout('leads::layout');
    }

    public function getActiveStepProperty()
    {
        return $this->leadType->steps()->where('slug', $this->step)->first();
    }

    public function getHasMoreStepsProperty()
    {
        return ! empty($this->activeStep->next());
    }

    public function submit()
    {
        $this->proceed();
    }

    protected function proceed()
    {
        //
    }
}
