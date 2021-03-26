<?php

namespace Roberts\Leads\Http\Livewire;

use Livewire\Component;
use Roberts\Leads\Models\LeadType;

class LeadForm extends Component
{
    public $leadType;

    public function mount(LeadType $leadType)
    {
        $this->leadType = $leadType;
    }

    public function render()
    {
        return view('leads::livewire.lead-form')
            ->layout('leads::layout');
    }
}
