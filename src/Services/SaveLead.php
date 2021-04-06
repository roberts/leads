<?php

namespace Roberts\Leads\Services;

use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadType;

interface SaveLead
{
    public function setLead(Lead $lead = null);

    public function setType(LeadType $leadType);

    public function fill($attributes = []);

    public function save();
}
