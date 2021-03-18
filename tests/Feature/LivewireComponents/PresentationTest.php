<?php

namespace Roberts\Leads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Roberts\Leads\Livewire\OnboardingForm\Presentation;
use Roberts\Leads\Tests\TestCase;

class PresentationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_user_can_create_a_lead()
    {
        $attributes = [
            'email' => $this->faker->email,
            'business_name' => $this->faker->company,
        ];

        Livewire::test(Presentation::class)
            ->set('attributes.email', $attributes['email'])
            ->set('attributes.business.name', $attributes['business_name'])
            ->call('submit');

        $this->assertDatabaseHas('lead_businesses', [
            'name' => $attributes['business_name'],
        ]);

        $this->assertDatabaseHas('leads', [
            'email' => $attributes['email'],
            'lead_business_id' => 1,
        ]);
    }

    /** @test */
    public function email_is_required()
    {
        Livewire::test(Presentation::class)
            ->set('attributes.email', '')
            ->assertHasErrors(['attributes.email' => 'required']);
    }

    /** @test */
    public function business_name_is_required()
    {
        Livewire::test(Presentation::class)
            ->set('attributes.business.name', '')
            ->assertHasErrors(['attributes.business.name' => 'required']);
    }
}
