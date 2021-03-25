<?php

namespace Roberts\Leads\Models;

use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class LeadStep extends BaseModel
{
    use HasCreator,
        HasUpdater,
        HasPackageFactory;

    protected $guarded = [
        'id',
    ];

    public function leadType()
    {
        return $this->belongsTo(LeadType::class);
    }
}
