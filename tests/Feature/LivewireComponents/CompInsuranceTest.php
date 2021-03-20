<?php

namespace Roberts\Leads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\Leads\Livewire\OnboardingForm\CompInsurance;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Tests\TestCase;

class CompInsuranceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_the_current_insurance_plan_details()
    {
        $business = LeadBusiness::factory()->create();

        $attributes = LeadBusiness::factory()
            ->withNullableFields()
            ->raw();

        Livewire::test(CompInsurance::class)
            ->set('lead', $business->lead)
            ->set('attributes.current_plan_under_cancellation', $attributes['current_plan_under_cancellation'])
            ->set('attributes.current_plan_expires_at', $attributes['current_plan_expires_at'])
            ->call('submit');

        $business->refresh();

        $this->assertEquals($attributes['current_plan_under_cancellation'], $business->current_plan_under_cancellation);
        $this->assertNotNull($business->current_plan_expires_at);
    }

    /** @test */
    public function current_plan_under_cancellation_is_required()
    {
        Livewire::test(CompInsurance::class)
            ->set('attributes.current_plan_under_cancellation', '')
            ->call('submit')
            ->assertHasErrors(['attributes.current_plan_under_cancellation' => 'required']);
    }

    /** @test */
    public function current_plan_under_cancellation_should_be_a_boolean()
    {
        Livewire::test(CompInsurance::class)
            ->set('attributes.current_plan_under_cancellation', 'invalid-value')
            ->call('submit')
            ->assertHasErrors(['attributes.current_plan_under_cancellation' => 'boolean']);
    }

    /** @test */
    public function current_plan_expires_at_is_required()
    {
        Livewire::test(CompInsurance::class)
            ->set('attributes.current_plan_expires_at', '')
            ->call('submit')
            ->assertHasErrors(['attributes.current_plan_expires_at' => 'required']);
    }

    /** @test */
    public function current_plan_expires_at_should_be_a_date()
    {
        Livewire::test(CompInsurance::class)
            ->set('attributes.current_plan_expires_at', 'invalid-date')
            ->call('submit')
            ->assertHasErrors(['attributes.current_plan_expires_at' => 'date']);
    }
}
