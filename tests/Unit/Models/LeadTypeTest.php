<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Roberts\Leads\Models\LeadField;
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
    public function it_has_a_slug()
    {
        $slug = $this->faker->slug;
        $leadType = LeadType::factory()->create(['slug' => $slug]);

        $this->assertEquals($slug, $leadType->slug);
    }

    /** @test */
    public function it_generates_a_slug_based_on_the_name_if_empty()
    {
        $name = $this->faker->word;
        $leadType = LeadType::factory()->create(['name' => $name]);

        $this->assertEquals(
            Str::slug($leadType->name),
            $leadType->slug
        );
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

    /** @test */
    public function it_has_fields()
    {
        $leadType = LeadType::factory()->create();
        $leadStep = LeadStep::factory()->create(['lead_type_id' => $leadType->id]);
        $leadField = LeadField::factory()->create(['lead_step_id' => $leadStep->id]);

        $this->assertCount(1, $leadType->fields);
        $this->assertInstanceOf(LeadField::class, $leadType->fields->first());
        $this->assertEquals($leadField->id, $leadType->fields->first()->id);
    }

    /** @test */
    public function it_has_an_initial_step()
    {
        $leadType = LeadType::factory()->create();
        $leadStep = LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 1,
        ]);

        LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 2,
        ]);

        $this->assertInstanceOf(LeadStep::class, $leadType->initialStep);
        $this->assertEquals($leadStep->id, $leadType->initialStep->id);
    }

    /** @test */
    public function it_uses_the_slug_value_for_route_model_binding()
    {
        $leadType = LeadType::factory()->create();

        $this->assertEquals('slug', $leadType->getRouteKeyName());
    }
}
