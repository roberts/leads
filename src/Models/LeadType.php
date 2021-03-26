<?php

namespace Roberts\Leads\Models;

use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasCreator;
use Tipoff\Support\Traits\HasPackageFactory;
use Tipoff\Support\Traits\HasUpdater;

class LeadType extends BaseModel
{
    use HasCreator,
        HasUpdater,
        HasPackageFactory;

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
}
