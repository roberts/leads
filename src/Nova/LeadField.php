<?php

namespace Roberts\Leads\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Roberts\Leads\Enums\LeadFieldType;
use Tipoff\Support\Nova\BaseResource;

class LeadField extends BaseResource
{
    public static $model = \Roberts\Leads\Models\LeadField::class;

    public static $title = 'label';

    public static $search = [
        'label',
        'name',
        'rules',
        'type',
        'lead_step_id',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),

            Text::make('Label')
                ->sortable()
                ->required(),

            Text::make('Name')
                ->sortable()
                ->required(),

            Text::make('Rules')
                ->sortable()
                ->required(),

            Select::make('Type')
                ->sortable()
                ->options([
                    LeadFieldType::TEXT => 'text',
                    LeadFieldType::NUMBER => 'number',
                    LeadFieldType::TEXTAREA => 'textarea',
                ])
                ->required(),

            BelongsTo::make('Step', 'leadStep')
                ->required()
                ->sortable(),
        ];
    }
}
