<div class="onboarding-form">
    @if ($step === \App\Enums\OnboardingFormStep::PRESENTATION)
        <livewire:onboarding-form.presentation :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::CONTACT_DETAILS)
        <livewire:onboarding-form.contact-details :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::MAILING_ADDRESS)
        <livewire:onboarding-form.mailing-address :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::BUSINESS_DETAILS)
        <livewire:onboarding-form.business-details :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::PAYROLL_CLASSIFICATIONS)
        <livewire:onboarding-form.payroll-classifications :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::COMP_INSURANCE_CHECK)
        <livewire:onboarding-form.comp-insurance-check :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::COMP_INSURANCE)
        <livewire:onboarding-form.comp-insurance :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::COMP_CLAIMS_CHECK)
        <livewire:onboarding-form.comp-claims-check :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::COMP_CLAIMS)
        <livewire:onboarding-form.comp-claims :lead="$lead" />
    @elseif ($step === \App\Enums\OnboardingFormStep::COMPLETED)
        <livewire:onboarding-form.completed :lead="$lead" />
    @endif
</div>
