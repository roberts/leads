<?php

namespace Roberts\WorkCompLeads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Roberts\WorkCompLeads\Livewire\OnboardingForm\CompClaims;
use Roberts\WorkCompLeads\Models\WcLead;
use Roberts\WorkCompLeads\Tests\TestCase;

class CompClaimsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_user_can_add_the_worker_claims_they_have_had()
    {
        $lead = WcLead::factory()->create();
        $pastCompClaims = $this->faker->paragraph;

        Livewire::test(CompClaims::class)
            ->set('lead', $lead)
            ->set('attributes.past_comp_claims', $pastCompClaims)
            ->call('submit');

        $this->assertEquals($pastCompClaims, $lead->refresh()->past_comp_claims);
    }

    /** @test **/
    public function past_comp_claims_is_required()
    {
        Livewire::test(CompClaims::class)
            ->set('attributes.past_comp_claims', '')
            ->call('submit')
            ->assertHasErrors();
    }
}
