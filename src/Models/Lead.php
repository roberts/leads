<?php

namespace Roberts\Leads\Models;

use Assert\Assert;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Roberts\Leads\Enums\LeadStatus;
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

    protected $guarded = [
        'id',
        'lead_number',
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
            $lead->lead_number = $lead->lead_number ?: $lead->generateLeadNumber();
        });

        static::created(function (Lead $lead) {
            $lead->setLeadStatus(LeadStatus::OPEN);
        });

        static::saving(function (Lead $lead) {
            Assert::lazy()
                ->that($lead->email)->notEmpty('A lead must have an email address.')
                ->verifyNow();
        });
    }

    protected function generateLeadNumber(): string
    {
        do {
            $token = Str::of(Carbon::now('America/New_York')->format('ymdB'))->substr(1, 7) . Str::upper(Str::random(2));
        } while (static::query()->where('lead_number', $token)->count()); //check if the token already exists and if it does, try again

        return $token;
    }

    public function type()
    {
        return $this->belongsTo(LeadType::class, 'lead_type_id');
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
}
