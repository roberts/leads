<?php

namespace Roberts\Leads\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\TestCase;

class LeadFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_the_lead_form()
    {
        $leadType = LeadType::factory()->create();

        $this->get($leadType->getRouteKey())
            ->assertOk()
            ->assertSee($leadType->name);
    }
}
