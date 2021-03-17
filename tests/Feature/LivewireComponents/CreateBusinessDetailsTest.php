<?php

namespace Roberts\WorkCompLeads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\WorkCompLeads\Livewire\OnboardingForm\BusinessDetails;
use Roberts\WorkCompLeads\Models\WcBusiness;
use Roberts\WorkCompLeads\Models\WcLead;
use Roberts\WorkCompLeads\Tests\TestCase;

class CreateBusinessDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_business()
    {
        $business = WcBusiness::factory()->create();
        $lead = WcLead::factory()->create(['wc_business_id' => $business->id]);

        $attributes = WcBusiness::factory()
            ->withNullableFields()
            ->raw(['name' => $business->name]);

        Livewire::test(BusinessDetails::class)
            ->set('lead', $lead)
            ->set('attributes.nature', $attributes['nature'])
            ->set('attributes.legal_entity_type', $attributes['legal_entity_type'])
            ->set('attributes.fein', $attributes['fein'])
            ->set('attributes.year_of_establishment', $attributes['year_of_establishment'])
            ->call('submit');

        $this->assertDatabaseHas('wc_businesses', $attributes);
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
