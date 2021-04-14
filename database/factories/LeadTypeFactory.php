<?php

namespace Roberts\Leads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\Leads\Models\LeadType;

class LeadTypeFactory extends Factory
{
    protected $model = LeadType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
        ];
    }
}
