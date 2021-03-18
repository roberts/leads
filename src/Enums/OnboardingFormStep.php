<?php

namespace Roberts\Leads\Enums;

use BenSampo\Enum\Enum;

final class OnboardingFormStep extends Enum
{
    const PRESENTATION = 'presentation';
    const CONTACT_DETAILS = 'contact-details';
    const MAILING_ADDRESS = 'mailing-address';
    const BUSINESS_DETAILS = 'business-details';
    const PAYROLL_CLASSIFICATIONS = 'payroll-classifications';
    const COMP_INSURANCE_CHECK = 'comp-insurance-check';
    const COMP_INSURANCE = 'comp-insurance';
    const COMP_CLAIMS_CHECK = 'comp-claims-check';
    const COMP_CLAIMS = 'comp-claims';
    const COMPLETED = 'completed';
}
