<?php

namespace Roberts\Leads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\Leads\Http\Livewire\OnboardingForm\MailingAddress;
use Roberts\Leads\Tests\TestCase;

class MailingAddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function zip_code_is_required()
    {
        Livewire::test(MailingAddress::class)
            ->set('attributes.zip_code', '')
            ->call('submit')
            ->assertHasErrors(['attributes.zip_code' => 'required']);
    }

    /** @test */
    public function mailing_address_is_required()
    {
        Livewire::test(MailingAddress::class)
            ->set('attributes.mailing_address', '')
            ->call('submit')
            ->assertHasErrors(['attributes.mailing_address' => 'required']);
    }

    /** @test */
    public function city_is_required()
    {
        Livewire::test(MailingAddress::class)
            ->set('attributes.city', '')
            ->call('submit')
            ->assertHasErrors(['attributes.city' => 'required']);
    }

    /** @test */
    public function state_is_required()
    {
        Livewire::test(MailingAddress::class)
            ->set('attributes.state', '')
            ->call('submit')
            ->assertHasErrors(['attributes.state' => 'required']);
    }
}
