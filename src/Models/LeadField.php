<?php

namespace Roberts\Leads\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class LeadField extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = [
        'id',
    ];

    public function leadStep()
    {
        return $this->belongsTo(LeadStep::class);
    }
}
