<?php

namespace Roberts\Leads\Models;

use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class LeadType extends BaseModel
{
    use HasPackageFactory;

    protected $guarded = [
        'id',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($type) {
            if (empty($type->slug)) {
                $type->slug = Str::slug($type->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function steps()
    {
        return $this->hasMany(LeadStep::class);
    }

    public function fields()
    {
        return $this->hasManyThrough(LeadField::class, LeadStep::class);
    }

    public function initialStep()
    {
        return $this->hasOne(LeadStep::class)->where('number', 1);
    }
}
