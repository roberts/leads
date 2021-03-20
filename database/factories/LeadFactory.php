<?php

namespace Roberts\Leads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Models\Lead;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
        ];
    }

    public function withNullableFields()
    {
        return $this->state(function () {
            return [
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'position' => $this->faker->word,
                'phone_number' => $this->faker->phoneNumber,
            ];
        });
    }
}
