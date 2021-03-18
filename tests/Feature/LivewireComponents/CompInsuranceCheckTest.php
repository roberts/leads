<?php

namespace Roberts\WorkCompLeads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\WorkCompLeads\Livewire\OnboardingForm\CompInsuranceCheck;
use Roberts\WorkCompLeads\Tests\TestCase;

class CompInsuranceCheckTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_add_insurance_details_is_required()
    {
        Livewire::test(CompInsuranceCheck::class)
            ->set('attributes.should_add_insurance_details', '')
            ->assertHasErrors(['attributes.should_add_insurance_details' => 'required']);
    }

    /** @test */
    public function should_add_insurance_details_should_be_a_boolean()
    {
        Livewire::test(CompInsuranceCheck::class)
            ->set('attributes.should_add_insurance_details', 'invalid-check')
            ->assertHasErrors(['attributes.should_add_insurance_details' => 'boolean']);
    }
}
