<?php

namespace Roberts\Leads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\LeadForm;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\TestCase;

class LeadFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_lead_form_component()
    {
        $leadType = LeadType::factory()->create();
        LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 1,
        ]);

        $this->get($leadType->getRouteKey())
            ->assertOk()
            ->assertSeeLivewire('lead-form');
    }

    /** @test */
    public function it_shows_the_lead_type_name()
    {
        $leadType = LeadType::factory()->create();
        LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => 1,
        ]);

        Livewire::test(LeadForm::class, ['leadType' => $leadType])
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

        Livewire::test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('step', $initialStep->slug)
            ->assertSee($initialStep->title);
    }

    /** @test */
    public function it_renders_the_step_defined_by_the_query_string()
    {
        $leadType = LeadType::factory()->create();
        $step = LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
        ]);

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('step', $step->slug)
            ->assertSee($step->title);
    }

    /** @test */
    public function it_can_tell_if_it_does_not_have_more_steps_ahead()
    {
        $leadType = LeadType::factory()->create();
        $step = LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
        ]);

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('hasMoreSteps', false)
            ->assertDontSee('Next');
    }

    /** @test */
    public function it_can_tell_if_it_has_more_steps_ahead()
    {
        $leadType = LeadType::factory()->create();
        $step = LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
        ]);
        LeadStep::factory()->create([
            'lead_type_id' => $leadType->id,
            'number' => $step->number + 1,
        ]);

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('hasMoreSteps', true)
            ->assertSee('Next');
    }
}