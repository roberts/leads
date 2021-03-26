<?php

namespace Roberts\Leads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\TestCase;

class LeadFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_lead_form()
    {
        $leadType = LeadType::factory()->create();
        LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 1,
        ]);

        $this->get($leadType->getRouteKey())
            ->assertOk()
            ->assertSee($leadType->name);
    }

    /** @test */
    public function it_starts_at_the_initial_step_if_no_step_is_defined()
    {
        $leadType = LeadType::factory()->create();
        $initialStep = LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 1,
        ]);

        $this->get($leadType->getRouteKey())
            ->assertSee($initialStep->title);
    }

    /** @test */
    public function it_renders_the_step_defined_by_the_query_string()
    {
        $leadType = LeadType::factory()->create();
        $anyStep = LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 2,
        ]);

        $this->get("{$leadType->getRouteKey()}?step={$anyStep->slug}")
            ->assertSee($anyStep->title);
    }
}
