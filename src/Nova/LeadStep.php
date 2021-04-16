<?php

namespace Roberts\Leads\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tipoff\Support\Nova\BaseResource;

class LeadStep extends BaseResource
{
    public static $model = \Roberts\Leads\Models\LeadStep::class;

    public static $title = 'title';

    public static $search = [
        'title',
        'slug',
        'number',
        'lead_type_id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->sortable()->required(),
            Text::make('Slug')->sortable(),
            Number::make('Number')->sortable()->required(),
            BelongsTo::make('Lead Type')->sortable(),
        ];
    }
}
