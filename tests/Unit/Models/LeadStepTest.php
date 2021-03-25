<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\TestCase;

class LeadStepTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_title()
    {
        $title = $this->faker->sentence;
        $leadStep = LeadStep::factory()->create(['title' => $title]);

        $this->assertEquals($title, $leadStep->title);
    }

    /** @test */
    public function it_has_a_slug()
    {
        $slug = $this->faker->slug;
        $leadStep = LeadStep::factory()->create(['slug' => $slug]);

        $this->assertEquals($slug, $leadStep->slug);
    }
    
    /** @test */
    public function it_belongs_to_a_lead_type()
    {
        $leadStep = LeadStep::factory()->create();

        $this->assertInstanceOf(LeadType::class, $leadStep->leadType);
    }
}
