<?php

namespace Roberts\Leads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\LeadForm;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadField;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Services\SaveLead;
use Roberts\Leads\Tests\Support\Services\SaveLeadSpy;
use Roberts\Leads\Tests\TestCase;

class LeadFormTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $saveLeadSpy;

    public function setUp(): void
    {
        parent::setUp();

        $this->saveLeadSpy = new SaveLeadSpy;
        $this->swap(SaveLead::class, $this->saveLeadSpy);
    }

    /** @test */
    public function it_shows_the_lead_form_component()
    {
        $leadType = $this->setUpLeadType();

        $this->get($leadType->getRouteKey())
            ->assertOk()
            ->assertSeeLivewire('lead-form');
    }

    /** @test */
    public function it_shows_the_lead_type_name()
    {
        $leadType = $this->setUpLeadType();

        Livewire::test(LeadForm::class, ['leadType' => $leadType])
            ->assertSee($leadType->name);
    }

    /** @test */
    public function it_starts_at_the_initial_step_if_no_step_is_defined()
    {
        $leadType = $this->setUpLeadType();
        $initialStep = $leadType->steps->where('number', 1)->first();

        Livewire::test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('step', $initialStep->slug)
            ->assertSee($initialStep->title);
    }

    /** @test */
    public function it_renders_the_step_defined_by_the_query_string()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps->random();

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('step', $step->slug)
            ->assertSee($step->title);
    }

    /** @test */
    public function it_shows_all_fields_attached_to_the_active_step()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps->random();
        $fields = $step->fields;

        $livewire = Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType]);

        $fields->each(function ($field) use ($livewire) {
            $livewire->assertSee($field->label)
                ->assertSeeHtml('type="' . $field->type . '"');
        });
    }

    /** @test */
    public function it_does_not_show_fields_from_other_steps()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps->random();
        $field = LeadField::factory()->create();

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertDontSee($field->label);
    }

    /** @test */
    public function it_can_tell_if_it_does_not_have_more_steps_ahead()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps->sortByDesc('number')->first();

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('hasMoreSteps', false)
            ->assertDontSee('Next');
    }

    /** @test */
    public function it_can_tell_if_it_has_more_steps_ahead()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps->where('number', 1)->first();

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('hasMoreSteps', true)
            ->assertSee('Next');
    }

    /** @test */
    public function it_proceeds_to_the_next_step_when_the_form_is_submitted()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps->where('number', 1)->first();
        $nextStep = $leadType->steps->where('number', 2)->first();

        $livewire = Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->assertSet('step', $step->slug);

        $step->fields->each(function ($field) use ($livewire) {
            $livewire->set("attributes.{$field->name}", $this->faker->randomNumber);
        });

        $livewire->call('submit')
            ->assertSet('step', $nextStep->slug)
            ->assertSee($nextStep->title);
    }

    /** @test */
    public function it_validates_the_lead_fields_upon_submit_call()
    {
        $leadType = $this->setUpLeadType();
        $step = $leadType->steps()->create(LeadStep::factory()->raw());
        $field = $step->fields()->create(LeadField::factory()->raw(['rules' => 'required']));

        Livewire::withQueryParams(['step' => $step->slug])
            ->test(LeadForm::class, ['leadType' => $leadType])
            ->set("attributes.{$field->name}", null)
            ->call('submit')
            ->assertHasErrors([
                "attributes.{$field->name}" => 'required',
            ])
            ->assertSee(__('validation.required', ['attribute' => $field->label]));
    }

    /** @test */
    public function it_calls_the_service_with_the_correct_data()
    {
        $leadType = $this->setUpLeadType();
        $lead = Lead::factory()->create();
        $attributes = [
            $this->faker->word => $this->faker->sentence,
        ];

        Livewire::test(LeadForm::class, ['leadType' => $leadType])
            ->set('lead', $lead)
            ->set('attributes', $attributes)
            ->call('submit');

        $this->assertNotNull($this->saveLeadSpy->lead);
        $this->assertEquals($lead->id, $this->saveLeadSpy->lead->id);
        $this->assertNotNull($this->saveLeadSpy->leadType);
        $this->assertEquals($leadType->id, $this->saveLeadSpy->leadType->id);
        $this->assertSame($attributes, $this->saveLeadSpy->attributes);
        $this->assertTrue($this->saveLeadSpy->saved);
    }

    /** @test */
    public function it_keeps_the_lead_updated()
    {
        $leadType = $this->setUpLeadType();
        $updatedLead = Lead::factory()->create();

        $this->mock(SaveLead::class, function ($mock) use ($updatedLead) {
            $mock->shouldReceive('setLead->setType->fill->save')
               ->andReturn($updatedLead);
        });

        Livewire::test(LeadForm::class, ['leadType' => $leadType])
            ->call('submit')
            ->assertSet('lead', $updatedLead);
    }

    protected function setUpLeadType()
    {
        $leadType = LeadType::factory()->create();

        for ($stepNumber = 1; $stepNumber <= 2; $stepNumber++) {
            $step = LeadStep::factory()
                ->create([
                    'lead_type_id' => $leadType->id,
                    'number' => $stepNumber,
                ]);

            LeadField::factory()
                ->count(2)
                ->create(['lead_step_id' => $step->id]);
        }

        return $leadType;
    }
}
