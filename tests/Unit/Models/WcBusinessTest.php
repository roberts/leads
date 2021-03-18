<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\Leads\Models\WcBusiness;
use Roberts\Leads\Tests\TestCase;

class WcBusinessTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_name()
    {
        $name = $this->faker->company;
        $business = WcBusiness::factory()->create(['name' => $name]);

        $this->assertEquals($name, $business->name);
    }

    /** @test */
    public function it_has_a_nature()
    {
        $nature = $this->faker->word;
        $business = WcBusiness::factory()->create(['nature' => $nature]);

        $this->assertEquals($nature, $business->nature);
    }

    /** @test */
    public function it_has_a_fein()
    {
        $fein = $this->faker->uuid;
        $business = WcBusiness::factory()->create(['fein' => $fein]);

        $this->assertEquals($fein, $business->fein);
    }

    /** @test */
    public function it_has_the_year_of_establishment()
    {
        $year = $this->faker->numberBetween(1900, 2010);
        $business = WcBusiness::factory()->create(['year_of_establishment' => $year]);

        $this->assertEquals($year, $business->year_of_establishment);
    }

    /** @test */
    public function it_has_a_legal_entity_type()
    {
        $type = $this->faker->word;
        $business = WcBusiness::factory()->create(['legal_entity_type' => $type]);

        $this->assertEquals($type, $business->legal_entity_type);
    }
}
