<?php

namespace Roberts\Leads\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class LeadType extends BaseResource
{
    public static $model = \Roberts\Leads\Models\LeadType::class;

    public static $title = 'name';

    public static $search = [
        'name', 'slug',
    ];

    public function fieldsForIndex(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Slug')->sortable(),
        ];
    }

    public function fields(Request $request)
    {
        return [
            ID::make(),
            Text::make('Name')->required(),
            Text::make('Slug'),
            HasMany::make('Steps'),
        ];
    }
}
