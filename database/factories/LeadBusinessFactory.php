<?php

namespace Roberts\Leads\Database\Factories;

use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadBusinessFactory extends Factory
{
    protected $model = LeadBusiness::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'lead_id' => Lead::factory(),
        ];
    }

    public function withNullableFields()
    {
        return $this->state(function () {
            return [
                'nature' => $this->faker->word,
                'fein' => $this->faker->uuid,
                'year_of_establishment' => $this->faker->numberBetween(1900, 2010),
                'legal_entity_type' => $this->faker->word,
                'current_plan_under_cancellation' => $this->faker->boolean,
                'current_plan_expires_at' => $this->faker->date,
                'past_comp_claims' => $this->faker->paragraph,
            ];
        });
    }
}
