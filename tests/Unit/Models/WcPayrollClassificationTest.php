<?php

namespace Roberts\WorkCompLeads\Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Roberts\WorkCompLeads\Models\WcLead;
use Roberts\WorkCompLeads\Models\WcPayrollClassification;
use Roberts\WorkCompLeads\Tests\TestCase;

class WcPayrollClassificationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_has_a_class_code()
    {
        $classCode = $this->faker->uuid;
        $classification = WcPayrollClassification::factory()->create(['class_code' => $classCode]);

        $this->assertEquals($classCode, $classification->class_code);
    }

    /** @test */
    public function it_has_a_number_of_employees()
    {
        $number = $this->faker->randomNumber;
        $classification = WcPayrollClassification::factory()->create(['number_of_employees' => $number]);

        $this->assertEquals($number, $classification->number_of_employees);
    }

    /** @test */
    public function it_has_an_annual_payroll()
    {
        $payroll = $this->faker->randomNumber;
        $classification = WcPayrollClassification::factory()->create(['annual_payroll' => $payroll]);

        $this->assertEquals($payroll, $classification->annual_payroll);
    }

    /** @test */
    public function it_is_associated_with_a_lead()
    {
        $classification = WcPayrollClassification::factory()->create();

        $this->assertInstanceOf(WcLead::class, $classification->lead);
    }
}
