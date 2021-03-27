<?php

namespace Roberts\Leads\Models;

use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class LeadStep extends BaseModel
{
    use HasCreator;
    use HasUpdater;
    use HasPackageFactory;

    protected $guarded = [
        'id',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($step) {
            if (empty($step->slug)) {
                $step->slug = Str::slug($step->title);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function leadType()
    {
        return $this->belongsTo(LeadType::class);
    }

    public function next()
    {
        return $this->leadType->steps()->where('number', $this->number + 1)->first();
    }
}
