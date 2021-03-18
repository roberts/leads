<?php

namespace Roberts\Leads\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class WcPayrollClassification extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
