<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Roberts\Leads\Enums\LeadStatus;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadBusiness;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Tests\Support\Models\Phone;
use Roberts\Leads\Tests\TestCase;
use Tipoff\Statuses\Models\StatusRecord;

class LeadTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_an_email()
    {
        $email = $this->faker->email;
        $lead = Lead::factory()->create(['email' => $email]);

        $this->assertEquals($email, $lead->email);
    }

    /** @test */
    public function it_has_the_first_name_of_the_lead_creator()
    {
        $firstName = $this->faker->firstName;
        $lead = Lead::factory()->create(['first_name' => $firstName]);

        $this->assertEquals($firstName, $lead->first_name);
    }

    /** @test */
    public function it_has_the_last_name_of_the_lead_creator()
    {
        $lastName = $this->faker->lastName;
        $lead = Lead::factory()->create(['last_name' => $lastName]);

        $this->assertEquals($lastName, $lead->last_name);
    }

    /** @test */
    public function it_has_a_list_of_custom_attributes()
    {
        $customAttributes = collect(['username' => $this->faker->userName]);

        $lead = Lead::factory()->create(['custom_attributes' => $customAttributes]);

        $this->assertEquals($customAttributes, $lead->custom_attributes);
    }

    /** @test */
    public function it_has_the_date_the_lead_was_verified_at()
    {
        $lead = Lead::factory()->create(['verified_at' => $this->faker->date]);

        $this->assertInstanceOf(Carbon::class, $lead->verified_at);
    }

    /** @test */
    public function it_has_the_date_the_form_was_completed_at()
    {
        $lead = Lead::factory()->create(['form_completed_at' => $this->faker->date]);

        $this->assertInstanceOf(Carbon::class, $lead->form_completed_at);
    }

    /** @test */
    public function it_has_a_phone()
    {
        $lead = Lead::factory()->withNullableFields()->create();

        $this->assertInstanceOf(Phone::class, $lead->phone);
    }

    /** @test */
    public function it_is_associated_with_a_business()
    {
        $lead = Lead::factory()->create();
        LeadBusiness::factory()->create(['lead_id' => $lead->id]);

        $this->assertInstanceOf(LeadBusiness::class, $lead->business);
    }

    /** @test */
    public function it_has_a_type()
    {
        $lead = Lead::factory()->create();

        $this->assertInstanceOf(LeadType::class, $lead->type);
    }

    /** @test */
    public function it_has_statuses()
    {
        $lead = Lead::factory()->create();

        $lead->setLeadStatus(LeadStatus::PARTIAL);

        $history = $lead->getLeadStatusHistory()
            ->map(function (StatusRecord $statusRecord) {
                return (string) $statusRecord->status;
            })->toArray();

        $this->assertEquals(
            [LeadStatus::PARTIAL, LeadStatus::OPEN],
            $history
        );
    }

    /** @test */
    public function it_sets_a_new_status()
    {
        $lead = Lead::factory()->create();

        $lead->setLeadStatus(LeadStatus::PARTIAL);

        $this->assertEquals(LeadStatus::PARTIAL, $lead->getLeadStatus());
    }

    /** @test */
    public function it_is_associated_with_an_open_status_as_it_is_created()
    {
        $lead = Lead::factory()->create();

        $this->assertEquals(LeadStatus::OPEN, $lead->getLeadStatus());
    }
}
