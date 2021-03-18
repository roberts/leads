<?php

namespace Roberts\Leads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\Leads\Models\WcBusiness;
use Roberts\Leads\Models\WcLead;

class WcLeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WcLead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'wc_business_id' => WcBusiness::factory(),
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
                'wc_business_id' => WcBusiness::factory(),
            ];
        });
    }
}
