<?php

namespace Roberts\Leads\Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Roberts\Leads\Exceptions\InvalidLeadProperty;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadField;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Services\SaveLead;
use Roberts\Leads\Tests\TestCase;
use Tipoff\Addresses\Models\Country;

class SaveLeadTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_sets_the_lead()
    {
        $lead = Lead::factory()->create();

        $savedLead = $this->service()
            ->setLead($lead)
            ->save();

        $this->assertEquals($lead->id, $savedLead->id);
    }

    /** @test */
    public function it_sets_the_lead_type()
    {
        $leadType = $this->setUpLeadType();
        $lead = Lead::factory()->create();

        $returnedLead = $this->service()
            ->setLead($lead)
            ->setType($leadType)
            ->save();

        $this->assertEquals($leadType->id, $returnedLead->lead_type_id);
    }

    /** @test */
    public function it_creates_a_lead()
    {
        $attributes = Lead::factory()->raw();

        $this->service()
            ->fill($attributes)
            ->save();

        $this->assertDatabaseHas('leads', Arr::only($attributes, 'email'));
    }

    /** @test */
    public function it_updates_a_lead()
    {
        $lead = Lead::factory()->create();
        $attributes = ['email' => $this->faker->unique()->email];

        $this->service()
            ->setLead($lead)
            ->fill($attributes)
            ->save();

        $this->assertEquals($attributes['email'], $lead->fresh()->email);
    }

    /** @test */
    public function it_creates_a_business()
    {
        $lead = Lead::factory()->create();

        $this->assertNull($lead->business);

        $attributes = [
            'business.name' => $this->faker->company,
        ];

        $returnedLead = $this->service()
            ->setLead($lead)
            ->fill($attributes)
            ->save();

        $this->assertNotNull($returnedLead->business);
        $this->assertEquals($attributes['business.name'], $returnedLead->business->name);
    }

    /** @test */
    public function it_fills_lead_attributes()
    {
        $attributes = ['first_name' => $this->faker->firstName];

        $returnedLead = $this->service()
            ->setLead(Lead::factory()->create())
            ->fill($attributes)
            ->save();

        $this->assertEquals($attributes['first_name'], $returnedLead->first_name);
    }

    /** @test */
    public function it_fills_custom_attributes()
    {
        $leadType = $this->setUpLeadType();
        $leadField = $leadType->fields->random();
        $lead = Lead::factory()->create(['lead_type_id' => $leadType]);

        $attributes = [$leadField->name => $this->faker->word];

        $returnedLead = $this->service()
            ->setLead($lead)
            ->fill($attributes)
            ->save();

        $this->assertArrayHasKey($leadField->name, $returnedLead->custom_attributes);
        $this->assertEquals($attributes[$leadField->name], $returnedLead->custom_attributes[$leadField->name]);
    }

    /** @test */
    public function it_throws_an_exception_when_a_property_cannot_be_found_in_the_lead_type_fields()
    {
        $lead = Lead::factory()->create([
            'lead_type_id' => $this->setUpLeadType(),
        ]);

        $attributes = ['invalid-property' => $this->faker->word];

        $this->expectException(InvalidLeadProperty::class);

        $this->service()
            ->setLead($lead)
            ->fill($attributes);
    }

    protected function service()
    {
        return app(SaveLead::class);
    }

    protected function setUpLeadType()
    {
        $leadType = LeadType::factory()->create();

        LeadStep::factory()
            ->count(2)
            ->create(['lead_type_id' => $leadType->id])
            ->each(function ($step) {
                LeadField::factory()
                    ->count(2)
                    ->create(['lead_step_id' => $step->id]);
            });

        return $leadType;
    }
}
