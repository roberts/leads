<?php

namespace Roberts\Leads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\Leads\Models\LeadField;
use Roberts\Leads\Models\LeadStep;
use Roberts\Leads\Tests\TestCase;

class LeadFieldTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_label()
    {
        $label = $this->faker->word;
        $field = LeadField::factory()->create(['label' => $label]);

        $this->assertEquals($label, $field->label);
    }

    /** @test */
    public function it_has_a_name()
    {
        $name = $this->faker->word;
        $field = LeadField::factory()->create(['name' => $name]);

        $this->assertEquals($name, $field->name);
    }

    /** @test */
    public function it_has_rules()
    {
        $rules = $this->faker->word;
        $field = LeadField::factory()->create(['rules' => $rules]);

        $this->assertEquals($rules, $field->rules);
    }

    /** @test */
    public function it_has_a_type()
    {
        $type = $this->faker->word;
        $field = LeadField::factory()->create(['type' => $type]);

        $this->assertEquals($type, $field->type);
    }

    /** @test */
    public function it_belongs_to_a_step()
    {
        $field = LeadField::factory()->create();

        $this->assertInstanceOf(LeadStep::class, $field->leadStep);
    }
}
