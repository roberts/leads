<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\TestCase;

class LeadStepTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_belongs_to_a_lead_type()
    {
        $leadStep = LeadStep::factory()->create();

        $this->assertInstanceOf(LeadType::class, $leadStep->leadType);
    }
}
