<?php

namespace Roberts\Leads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadType;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'lead_type_id' => LeadType::factory(),
            'custom_attributes' => [],
        ];
    }

    public function withNullableFields()
    {
        return $this->state(function () {
            return [
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'phone_number' => $this->faker->phoneNumber,
            ];
        });
    }
}
