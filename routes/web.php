<?php

use Illuminate\Support\Facades\Route;
use Roberts\WorkCompLeads\Http\Controllers\OnboardingFormController;

Route::get('/workerscompensation/quotes', OnboardingFormController::class);
