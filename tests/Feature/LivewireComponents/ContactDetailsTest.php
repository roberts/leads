<?php

namespace Roberts\WorkCompLeads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\WorkCompLeads\Livewire\OnboardingForm\ContactDetails;
use Roberts\WorkCompLeads\Models\WcLead;
use Roberts\WorkCompLeads\Tests\TestCase;

class ContactDetailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_their_contact_details()
    {
        $lead = WcLead::factory()->create();

        $attributes = WcLead::factory()
            ->withNullableFields()
            ->raw();

        Livewire::test(ContactDetails::class)
            ->set('lead', $lead)
            ->set('attributes.first_name', $attributes['first_name'])
            ->set('attributes.last_name', $attributes['last_name'])
            ->set('attributes.position', $attributes['position'])
            ->set('attributes.phone_number', $attributes['phone_number'])
            ->call('submit');

        $lead->refresh();

        $this->assertEquals($attributes['first_name'], $lead->first_name);
        $this->assertEquals($attributes['last_name'], $lead->last_name);
        $this->assertEquals($attributes['position'], $lead->position);
        $this->assertEquals($attributes['phone_number'], $lead->phone_number);
    }

    /** @test */
    public function first_name_is_required()
    {
        Livewire::test(ContactDetails::class)
            ->set('attributes.first_name', '')
            ->call('submit')
            ->assertHasErrors(['attributes.first_name' => 'required']);
    }

    /** @test */
    public function last_name_is_required()
    {
        Livewire::test(ContactDetails::class)
            ->set('attributes.last_name', '')
            ->call('submit')
            ->assertHasErrors(['attributes.last_name' => 'required']);
    }

    /** @test */
    public function position_is_required()
    {
        Livewire::test(ContactDetails::class)
            ->set('attributes.position', '')
            ->call('submit')
            ->assertHasErrors(['attributes.position' => 'required']);
    }

    /** @test */
    public function phone_number_is_required()
    {
        Livewire::test(ContactDetails::class)
            ->set('attributes.phone_number', '')
            ->call('submit')
            ->assertHasErrors(['attributes.phone_number' => 'required']);
    }
}
