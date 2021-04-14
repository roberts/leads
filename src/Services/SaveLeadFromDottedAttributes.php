<?php

namespace Roberts\Leads\Services;

use Illuminate\Support\Arr;
use Roberts\Leads\Exceptions\InvalidLeadProperty;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Models\LeadType;

class SaveLeadFromDottedAttributes implements SaveLead
{
    protected $lead;
    protected $business;
    protected $phone;

    protected function loadProperties()
    {
        if (is_null($this->lead)) {
            $this->lead = new Lead;
        }

        if (is_null($this->business)) {
            $this->business = $this->lead->business;
        }

        if (is_null($this->phone)) {
            $this->phone = $this->lead->phone;
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
        $this->loadProperties();

        $this->lead->lead_type_id = $leadType->id;

        return $this;
    }

    protected function parseAttributes($attributes)
    {
        $parsedArray = [];

        foreach ($attributes as $key => $value) {
            Arr::set($parsedArray, $key, $value);
        }

        return $parsedArray;
    }

    public function fill($attributes = [])
    {
        $this->loadProperties();

        $attributes = $this->parseAttributes($attributes);

        foreach ($attributes as $key => $value) {
            if ($this->lead->attributeExists($key)) {
                $this->lead->{$key} = $value;
            } elseif ($this->lead->customAttributeExists($key)) {
                $this->lead->setCustomAttribute($key, $value);
            } elseif ($key === 'business') {
                $this->business = $this->business ?: new LeadBusiness;
                $this->business->fill($attributes['business']);
            } else {
                throw InvalidLeadProperty::create($key);
            }
        }

        return $this;
    }

    public function save()
    {
        $this->loadProperties();

        $this->lead->save();

        if ($this->business) {
            $this->lead->business()->save($this->business);
        }

        return $this->lead->fresh();
    }
}
