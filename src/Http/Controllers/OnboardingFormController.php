<?php

namespace Roberts\WorkCompLeads\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class OnboardingFormController extends BaseController
{
    public function __invoke()
    {
        return view('onboarding-form');
    }
}
