<?php

namespace Roberts\Leads\Tests\Feature\LivewireComponents;

use Livewire\Livewire;
use Roberts\Leads\Livewire\OnboardingForm\CompClaimsCheck;
use Roberts\Leads\Tests\TestCase;

class CompClaimsCheckTest extends TestCase
{
    /** @test */
    public function should_add_claims_is_required()
    {
        Livewire::test(CompClaimsCheck::class)
            ->set('attributes.should_add_claims', '')
            ->assertHasErrors(['attributes.should_add_claims' => 'required']);
    }

    /** @test */
    public function should_add_claims_should_be_a_boolean()
    {
        Livewire::test(CompClaimsCheck::class)
            ->set('attributes.should_add_claims', 'invalid-check')
            ->assertHasErrors(['attributes.should_add_claims' => 'boolean']);
    }
}
