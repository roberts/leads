<?php

namespace Roberts\Leads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Roberts\Leads\Tests\TestCase;

class ViewOnboardingPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_the_onboarding_page()
    {
        $this->get('/workerscompensation/quotes')
            ->assertOk()
            ->assertSeeLivewire('onboarding-form');
    }
}
