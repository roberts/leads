<?php

use Illuminate\Support\Facades\Route;
use Roberts\Leads\Http\Controllers\OnboardingFormController;

Route::get('/workerscompensation/quotes', OnboardingFormController::class);
