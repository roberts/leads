<?php

namespace Roberts\Leads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\Leads\Models\LeadField;
use Roberts\Leads\Models\LeadStep;

class LeadFieldFactory extends Factory
{
    protected $model = LeadField::class;

    public function definition()
    {
        $name = $this->faker->unique()->word;

        return [
            'name' => $name,
            'label' => strtoupper($name),
            'rules' => 'nullable',
            'type' => $this->faker->randomElement(['text', 'number']),
            'lead_step_id' => LeadStep::factory(),
        ];
    }
}
