<?php

namespace Roberts\Leads\Models;

use Roberts\Leads\Enums\LeadStatus;
use Roberts\Leads\Services\GenerateLeadNumber;
use Tipoff\Statuses\Traits\HasStatuses;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class Lead extends BaseModel
{
    use HasCreator;
    use HasPackageFactory;
    use HasUpdater;
    use HasStatuses;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'custom_attributes',
        'lead_type_id',
        'phone_id',
        'user_id',
        'creator_id',
        'updater_id',
    ];

    protected $casts = [
        'form_completed_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    const STATUS_TYPE = 'lead';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Lead $lead) {
            if (empty($lead->lead_number)) {
                $lead->lead_number = app(GenerateLeadNumber::class)->__invoke($lead);
            }
        });

        static::created(function (Lead $lead) {
            $lead->setLeadStatus(LeadStatus::OPEN);
        });
    }

    public function type()
    {
        return $this->belongsTo(LeadType::class, 'lead_type_id');
    }

    public function phone()
    {
        return $this->belongsTo(app('phone'));
    }

    public function setLeadStatus(string $status)
    {
        return $this->setStatus($status, static::STATUS_TYPE);
    }

    public function getLeadStatus()
    {
        return $this->getStatus(static::STATUS_TYPE);
    }

    public function getLeadStatusHistory()
    {
        return $this->getStatusHistory(static::STATUS_TYPE);
    }

    public function business()
    {
        return $this->hasOne(LeadBusiness::class);
    }

    public function getCustomAttributesAttribute($value)
    {
        return ! empty($value) ? collect(json_decode($value, true)) : [];
    }

    public function setCustomAttributesAttribute($value)
    {
        $this->attributes['custom_attributes'] = json_encode($value);
    }

    public function attributeExists($attribute)
    {
        return in_array($attribute, $this->getFillable(), true);
    }

    public function customAttributeExists($attribute)
    {
        return !empty($this->type)
            && in_array($attribute, $this->type->fields->pluck('name')->toArray(), true);
    }
}
