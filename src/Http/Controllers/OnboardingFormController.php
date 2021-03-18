<?php

namespace Roberts\Leads\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class OnboardingFormController extends BaseController
{
    public function __invoke()
    {
        return view('onboarding-form');
    }
}
