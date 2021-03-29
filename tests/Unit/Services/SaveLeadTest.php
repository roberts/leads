<?php

namespace Roberts\Leads\Tests\Unit\Services;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\Leads\Exceptions\InvalidLeadProperty;
use Roberts\Leads\Models\Lead;
use Roberts\Leads\Models\LeadField;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Models\LeadType;
use Roberts\Leads\Services\SaveLead;
use Roberts\Leads\Tests\TestCase;

class SaveLeadTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_sets_the_lead_type()
    {
        $leadType = $this->setUpLeadType();

        $this->service()
            ->withLeadType($leadType)
            ->save(['email' => $this->faker->email]);

        $this->assertDatabaseHas('leads', [
            'lead_type_id' => $leadType->id,
        ]);
    }

    /** @test */
    public function it_creates_a_lead()
    {
        $attributes = [
            'email' => $this->faker->email,
        ];

        $this->service()
            ->withLeadType($this->setUpLeadType())
            ->save($attributes);

        $this->assertDatabaseHas('leads', $attributes);
    }

    /** @test */
    public function it_updates_a_lead()
    {
        $previousAttributes = [
            'email' => $this->faker->unique()->email,
            'lead_type_id' => $this->setUpLeadType()->id,
        ];
        $attributes = ['email' => $this->faker->unique()->email];

        $lead = Lead::factory()->create($previousAttributes);

        $this->service($lead)
            ->save($attributes);

        $this->assertNotEquals($previousAttributes['email'], $lead->email);
        $this->assertEquals($attributes['email'], $lead->email);
    }

    /** @test */
    public function it_creates_a_phone()
    {
    }

    /** @test */
    public function it_updates_a_phone()
    {
    }

    /** @test */
    public function it_creates_a_business()
    {
    }

    /** @test */
    public function it_updates_a_business()
    {
    }

    /** @test */
    public function it_saves_a_lead_attribute()
    {
        $lead = Lead::factory()->create([
            'lead_type_id' => $this->setUpLeadType()->id,
        ]);

        $attributes = ['first_name' => $this->faker->firstName];

        $this->service($lead)
            ->save($attributes);

        $this->assertEquals($attributes['first_name'], $lead->first_name);
    }

    /** @test */
    public function it_saves_a_custom_attribute()
    {
        $leadType = $this->setUpLeadType();
        $leadField = $leadType->fields->random();
        $lead = Lead::factory()->create(['lead_type_id' => $leadType]);

        $attributes = [$leadField->name => $this->faker->word];

        $this->service($lead)
            ->save($attributes);

        $this->assertArrayHasKey($leadField->name, $lead->custom_attributes);
        $this->assertEquals($attributes[$leadField->name], $lead->custom_attributes[$leadField->name]);
    }

    /** @test */
    public function it_throws_an_exception_when_a_property_cannot_be_found()
    {
        $lead = Lead::factory()->create([
            'lead_type_id' => $this->setUpLeadType(),
        ]);

        $attributes = ['invalid-property' => $this->faker->word];

        $this->expectException(InvalidLeadProperty::class);

        $this->service($lead)
            ->save($attributes);
    }

    protected function service(Lead $lead = null)
    {
        return new SaveLead($lead);
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
