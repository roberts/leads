<?php

namespace Roberts\Leads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\OnboardingForm\BusinessDetails;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Tests\TestCase;

class BusinessDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_business_details()
    {
        $lead = Lead::factory()->create();
        $business = LeadBusiness::factory()->create(['lead_id' => $lead->id]);

        $attributes = LeadBusiness::factory()
            ->withNullableFields()
            ->raw([
                'name' => $business->name,
                'lead_id' => $lead->id,
                'current_plan_under_cancellation' => null,
                'current_plan_expires_at' => null,
                'past_comp_claims' => null,
            ]);

        Livewire::test(BusinessDetails::class)
            ->set('lead', $lead)
            ->set('attributes.nature', $attributes['nature'])
            ->set('attributes.legal_entity_type', $attributes['legal_entity_type'])
            ->set('attributes.fein', $attributes['fein'])
            ->set('attributes.year_of_establishment', $attributes['year_of_establishment'])
            ->call('submit');

        $this->assertDatabaseHas('lead_businesses', $attributes);
    }

    /** @test */
    public function nature_is_required()
    {
        Livewire::test(BusinessDetails::class)
            ->set('attributes.nature', '')
            ->call('submit')
            ->assertHasErrors(['attributes.nature' => 'required']);
    }

    /** @test */
    public function legal_entity_type_is_required()
    {
        Livewire::test(BusinessDetails::class)
            ->set('attributes.legal_entity_type', '')
            ->call('submit')
            ->assertHasErrors(['attributes.legal_entity_type' => 'required']);
    }

    /** @test */
    public function fein_is_required()
    {
        Livewire::test(BusinessDetails::class)
            ->set('attributes.fein', '')
            ->call('submit')
            ->assertHasErrors(['attributes.fein' => 'required']);
    }

    /** @test */
    public function year_of_establishment_is_required()
    {
        Livewire::test(BusinessDetails::class)
            ->set('attributes.year_of_establishment', '')
            ->call('submit')
            ->assertHasErrors(['attributes.year_of_establishment' => 'required']);
    }

    /** @test */
    public function year_of_establishment_should_be_an_integer()
    {
        Livewire::test(BusinessDetails::class)
            ->set('attributes.year_of_establishment', 'invalid-year')
            ->call('submit')
            ->assertHasErrors(['attributes.year_of_establishment' => 'integer']);
    }
}
