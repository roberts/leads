<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Tests\TestCase;

class LeadBusinessTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_name()
    {
        $name = $this->faker->company;
        $business = LeadBusiness::factory()->create(['name' => $name]);

        $this->assertEquals($name, $business->name);
    }

    /** @test */
    public function it_has_a_nature()
    {
        $nature = $this->faker->word;
        $business = LeadBusiness::factory()->create(['nature' => $nature]);

        $this->assertEquals($nature, $business->nature);
    }

    /** @test */
    public function it_has_a_fein()
    {
        $fein = $this->faker->uuid;
        $business = LeadBusiness::factory()->create(['fein' => $fein]);

        $this->assertEquals($fein, $business->fein);
    }

    /** @test */
    public function it_has_the_year_of_establishment()
    {
        $year = $this->faker->numberBetween(1900, 2010);
        $business = LeadBusiness::factory()->create(['year_of_establishment' => $year]);

        $this->assertEquals($year, $business->year_of_establishment);
    }

    /** @test */
    public function it_has_a_legal_entity_type()
    {
        $type = $this->faker->word;
        $business = LeadBusiness::factory()->create(['legal_entity_type' => $type]);

        $this->assertEquals($type, $business->legal_entity_type);
    }

    /** @test */
    public function it_has_the_expiration_date_for_the_current_comp_plan()
    {
        $business = LeadBusiness::factory()->create(['current_plan_expires_at' => $this->faker->date]);

        $this->assertInstanceOf(Carbon::class, $business->current_plan_expires_at);
    }

    /** @test */
    public function it_has_the_details_of_the_past_comp_claims()
    {
        $pastCompClaims = $this->faker->paragraph;
        $business = LeadBusiness::factory()->create(['past_comp_claims' => $pastCompClaims]);

        $this->assertEquals($pastCompClaims, $business->past_comp_claims);
    }

    /** @test */
    public function it_has_an_under_cancellation_flag_for_the_current_plan()
    {
        $underCancellation = $this->faker->boolean;
        $business = LeadBusiness::factory()->create(['current_plan_under_cancellation' => $underCancellation]);

        $this->assertEquals($underCancellation, $business->current_plan_under_cancellation);
    }

    /** @test */
    public function it_belongs_to_a_lead()
    {
        $business = LeadBusiness::factory()->create();

        $this->assertInstanceOf(Lead::class, $business->lead);
    }
}
