<?php

namespace Roberts\Leads\Services;

use Roberts\Leads\Models\Lead;

abstract class GenerateLeadNumber
{
    abstract public function __invoke(Lead $lead);

    protected function leadNumberExists($leadNumber)
    {
        return Lead::where('lead_number', $leadNumber)->exists();
    }
}
