<?php

namespace Roberts\Leads\Models;

use Assert\Assert;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class WcLead extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = [
        'id',
        'lead_number',
    ];

    protected $casts = [
        'current_plan_expires_at' => 'date',
        'current_plan_under_cancellation' => 'boolean',
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function (WcLead $lead) {
            $lead->lead_number = $lead->lead_number ?: $lead->generateLeadNumber();
        });

        static::saving(function (WcLead $lead) {
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

    public function business()
    {
        return $this->belongsTo(WcBusiness::class, 'wc_business_id');
    }

    public function payrollClassifications()
    {
        return $this->hasMany(WcPayrollClassification::class);
    }
}
