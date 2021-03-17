<?php

namespace Roberts\WorkCompLeads\Tests\Feature\LivewireComponents;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Roberts\WorkCompLeads\Livewire\OnboardingForm\PayrollClassifications;
use Roberts\WorkCompLeads\Models\WcLead;
use Roberts\WorkCompLeads\Models\WcPayrollClassification;
use Roberts\WorkCompLeads\Tests\TestCase;

class CreatePayrollClassificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_payroll_classification()
    {
        $lead = WcLead::factory()->create();
        $attributes = WcPayrollClassification::factory()->raw(['wc_lead_id' => $lead]);

        Livewire::test(PayrollClassifications::class)
            ->set('lead', $lead)
            ->set('attributes.class_code', $attributes['class_code'])
            ->set('attributes.number_of_employees', $attributes['number_of_employees'])
            ->set('attributes.annual_payroll', $attributes['annual_payroll'])
            ->call('submit');

        $this->assertDatabaseHas('wc_payroll_classifications', $attributes);
    }

    /** @test */
    public function class_code_is_required()
    {
        $lead = WcLead::factory()->create();

        Livewire::test(PayrollClassifications::class)
            ->set('lead', $lead)
            ->set('attributes.class_code', '')
            ->call('submit')
            ->assertHasErrors(['attributes.class_code' => 'required']);
    }

    /** @test */
    public function number_of_employees_is_required()
    {
        $lead = WcLead::factory()->create();

        Livewire::test(PayrollClassifications::class)
            ->set('lead', $lead)
            ->set('attributes.number_of_employees', '')
            ->call('submit')
            ->assertHasErrors(['attributes.number_of_employees' => 'required']);
    }

    /** @test */
    public function number_of_employees_should_be_an_integer()
    {
        $lead = WcLead::factory()->create();

        Livewire::test(PayrollClassifications::class)
            ->set('lead', $lead)
            ->set('attributes.number_of_employees', 'invalid-number-of-employees-payroll')
            ->call('submit')
            ->assertHasErrors(['attributes.number_of_employees' => 'integer']);
    }

    /** @test */
    public function annual_payroll_is_required()
    {
        $lead = WcLead::factory()->create();

        Livewire::test(PayrollClassifications::class)
            ->set('lead', $lead)
            ->set('attributes.annual_payroll', '')
            ->call('submit')
            ->assertHasErrors(['attributes.annual_payroll' => 'required']);
    }

    /** @test */
    public function annual_payroll_should_be_numeric()
    {
        $lead = WcLead::factory()->create();

        Livewire::test(PayrollClassifications::class)
            ->set('lead', $lead)
            ->set('attributes.annual_payroll', 'invalid-annual-payroll')
            ->call('submit')
            ->assertHasErrors(['attributes.annual_payroll' => 'numeric']);
    }
}
