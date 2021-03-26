<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
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
    public function it_generates_a_slug_based_on_the_title_if_empty()
    {
        $title = $this->faker->sentence;
        $leadStep = LeadStep::factory()->create(['title' => $title]);

        $this->assertEquals(
            Str::slug($leadStep->title),
            $leadStep->slug
        );
    }

    /** @test */
    public function it_has_an_number()
    {
        $number = $this->faker->randomNumber;
        $leadStep = LeadStep::factory()->create(['number' => $number]);

        $this->assertEquals($number, $leadStep->number);
    }

    /** @test */
    public function it_belongs_to_a_lead_type()
    {
        $leadStep = LeadStep::factory()->create();

        $this->assertInstanceOf(LeadType::class, $leadStep->leadType);
    }

    /** @test */
    public function it_uses_the_slug_value_for_route_model_binding()
    {
        $leadStep = LeadStep::factory()->create();

        $this->assertEquals('slug', $leadStep->getRouteKeyName());
    }

    /** @test */
    public function it_determines_the_next_step_by_incrementing_its_number()
    {
        $leadStep = LeadStep::factory()->create();
        $expectedNextStep = LeadStep::factory()->create([
            'number' => $leadStep->number + 1,
            'lead_type_id' => $leadStep->lead_type_id,
        ]);

        $nextStep = $leadStep->next();

        $this->assertInstanceOf(LeadStep::class, $nextStep);
        $this->assertEquals($expectedNextStep->id, $nextStep->id);
    }
}
