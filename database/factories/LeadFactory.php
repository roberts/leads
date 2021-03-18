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
            'lead_business_id' => LeadBusiness::factory(),
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
                'current_plan_under_cancellation' => $this->faker->boolean,
                'current_plan_expires_at' => $this->faker->date,
                'past_comp_claims' => $this->faker->paragraph,
                'lead_business_id' => LeadBusiness::factory(),
            ];
        });
    }
}
