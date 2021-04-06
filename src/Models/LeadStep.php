<?php

namespace Roberts\Leads\Models;

use Illuminate\Support\Str;
use Tipoff\Support\Models\BaseModel;
use Tipoff\Support\Traits\HasPackageFactory;

class LeadStep extends BaseModel
{
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

    public function fields()
    {
        return $this->hasMany(LeadField::class);
    }

    public function next()
    {
        return $this->leadType->steps()->where('number', $this->number + 1)->first();
    }
}
