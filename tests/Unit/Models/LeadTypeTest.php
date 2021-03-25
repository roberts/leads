<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\TestCase;

class LeadTypeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_name()
    {
        $name = $this->faker->word;
        $leadType = LeadType::factory()->create(['name' => $name]);

        $this->assertEquals($name, $leadType->name);
    }

    /** @test */
    public function it_has_one_or_more_steps()
    {
        $leadType = LeadType::factory()->create();
        $leadStep = LeadStep::factory()->create(['lead_type_id' => $leadType->id]);

        $this->assertCount(1, $leadType->steps);
        $this->assertInstanceOf(LeadStep::class, $leadType->steps->first());
        $this->assertEquals($leadStep->id, $leadType->steps->first()->id);
    }
}
