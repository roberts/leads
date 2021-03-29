<?php

namespace Roberts\Leads\Services;

use Illuminate\Support\Arr;
use Roberts\Leads\Exceptions\InvalidLeadProperty;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadType;

class SaveLead
{
    protected $lead;

    public function __construct(Lead $lead = null)
    {
        $this->lead = !is_null($lead) ? $lead : new Lead;
    }

    public function withLeadType(LeadType $leadType)
    {
        $this->lead->lead_type_id = $leadType->id;

        return $this;
    }

    public function save($attributes = [])
    {
        $customAttributes = $this->lead->custom_attributes;

        foreach ($attributes as $dottedKey => $value) {
            $key = explode('.', $dottedKey)[0] ?: null;

            if ($this->lead->attributeExists($key)) {
                $this->lead->{$key} = $value;
            } elseif ($this->lead->customAttributeExists($key)) {
                Arr::set($customAttributes, $key, $value);
            } elseif ($key === 'phone') {
                // fill/create or update phone
            } elseif ($key === 'business') {
                // fill/create or update business
            } else {
                throw InvalidLeadProperty::create($key);
            }
        }

        $this->lead->custom_attributes = $customAttributes;

        // save phone and business
        $this->lead->save();

        return $this->lead;
    }
}
