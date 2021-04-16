<?php

namespace Roberts\Leads\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Tipoff\Support\Nova\BaseResource;

class LeadType extends BaseResource
{
    public static $model = \Roberts\Leads\Models\LeadType::class;

    public static $title = 'name';

    public static $search = [
        'name', 'slug',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),

            Text::make('Name')
                ->sortable()
                ->required(),

            Text::make('Slug')
                ->sortable(),

            HasMany::make('Steps')
                ->onlyOnDetail(),
        ];
    }
}
