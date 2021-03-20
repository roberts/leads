<?php

namespace Roberts\Leads\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class LeadBusiness extends BaseModel
{
    use HasPackageFactory;

    protected $casts = [
        'current_plan_expires_at' => 'date',
        'current_plan_under_cancellation' => 'boolean',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
