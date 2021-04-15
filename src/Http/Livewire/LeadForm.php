<?php

namespace Roberts\Leads\Http\Livewire;

use Livewire\Component;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Services\SaveLead;

class LeadForm extends Component
{
    public $leadType;
    public $step;
    protected $queryString = ['step'];
    public $attributes = [];
    public $lead;
    public $activeStep;

    public function mount(LeadType $leadType)
    {
        $this->leadType = $leadType;

        if (empty($this->step)) {
            $this->step = $this->leadType->initialStep->slug;
        }

        $this->activeStep = $this->getActiveStep();
    }

    public function render()
    {
        /**
         * @psalm-suppress UndefinedMethod
         */
        return view('leads::livewire.lead-form')
            ->extends('support::base');
    }

    protected function rules()
    {
        return $this->activeStep->fields
            ->keyBy(function ($field) {
                return "attributes.{$field->name}";
            })
            ->map(function ($field) {
                return $field->rules;
            })
            ->toArray();
    }

    protected function validationAttributes()
    {
        return $this->activeStep->fields
            ->keyBy(function ($field) {
                return "attributes.{$field->name}";
            })
            ->map(function ($field) {
                return $field->label;
            })
            ->toArray();
    }

    public function getHasMoreStepsProperty()
    {
        return ! empty($this->activeStep->next());
    }

    public function submit()
    {
        $this->validate();

        $this->lead = app(SaveLead::class)
            ->setLead($this->lead)
            ->setType($this->leadType)
            ->fill($this->attributes)
            ->save();

        $this->proceed();
    }

    protected function proceed()
    {
        if ($this->hasMoreSteps) {
            $step = $this->activeStep->next();
            $this->step = $step->slug;
            $this->activeStep = $step;
        }
    }

    protected function getActiveStep()
    {
        return $this->leadType->steps()->where('slug', $this->step)->first();
    }
}
