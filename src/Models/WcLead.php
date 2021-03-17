<?php

namespace Roberts\WorkCompLeads\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class WcLead extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = [];

    protected $casts = [
        'current_plan_expires_at' => 'date',
    ];

    public function business()
    {
        return $this->belongsTo(WcBusiness::class, 'wc_business_id');
    }

    public function payrollClassifications()
    {
        return $this->hasMany(WcPayrollClassification::class);
    }
}
