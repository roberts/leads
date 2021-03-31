<?php

namespace Roberts\Leads\Tests\Support\Services;

use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Services\SaveLead;

class SaveLeadSpy implements SaveLead
{
    public $lead;
    public $leadType;
    public $attributes = [];
    public $saved = false;

    public function setLead(Lead $lead = null)
    {
        $this->lead = $lead;

        return $this;
    }

    public function setType(LeadType $leadType)
    {
        $this->leadType = $leadType;

        return $this;
    }

    public function fill($attributes = [])
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function save()
    {
        $this->saved = true;

        return $this->lead;
    }
}
