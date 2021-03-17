<?php

namespace Roberts\WorkCompLeads\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class WcPayrollClassification extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(WcLead::class, 'wc_lead_id');
    }
}
