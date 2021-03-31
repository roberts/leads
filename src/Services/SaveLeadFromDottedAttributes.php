<?php

namespace Roberts\Leads\Services;

use Illuminate\Support\Arr;
use Roberts\Leads\Exceptions\InvalidLeadProperty;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadType;

class SaveLeadFromDottedAttributes implements SaveLead
{
    protected $lead;

    protected function ensureLeadIsSet()
    {
        if (is_null($this->lead)) {
            $this->lead = new Lead;
        }

        return $this;
    }

    public function setLead(Lead $lead = null)
    {
        $this->lead = $lead;

        return $this;
    }

    public function setType(LeadType $leadType)
    {
        $this->ensureLeadIsSet();

        $this->lead->lead_type_id = $leadType->id;

        return $this;
    }

    public function fill($attributes = [])
    {
        $this->ensureLeadIsSet();


        foreach ($attributes as $dottedKey => $value) {
            $key = explode('.', $dottedKey)[0] ?: null;

            if ($this->lead->attributeExists($key)) {
                $this->lead->{$key} = $value;
            } elseif ($this->lead->customAttributeExists($key)) {
                $this->lead->custom_attributes = Arr::add($this->lead->custom_attributes, $key, $value);
            } elseif ($key === 'phone') {
                // fill/create or update phone
            } elseif ($key === 'business') {
                // fill/create or update business
            } else {
                throw InvalidLeadProperty::create($key);
            }
        }

        return $this;
    }

    public function save()
    {
        $this->ensureLeadIsSet();

        $this->lead->save();

        return $this->lead;
    }
}
