<?php

namespace Roberts\WorkCompLeads\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Roberts\WorkCompLeads\Models\WcBusiness;
use Roberts\WorkCompLeads\Models\WcLead;

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
}
