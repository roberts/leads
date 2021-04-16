<?php

namespace Roberts\Leads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;

class LeadStepFactory extends Factory
{
    protected $model = LeadStep::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'number' => $this->faker->unique()->randomNumber,
            'lead_type_id' => LeadType::factory(),
        ];
    }
}
