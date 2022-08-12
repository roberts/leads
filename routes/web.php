<?php

use Illuminate\Support\Facades\Route;
use Roberts\Leads\Http\Livewire\LeadForm;

Route::middleware(config('tipoff.web.middleware_group'))
    ->prefix(config('tipoff.web.uri_prefix'))
    ->group(function () {
        Route::get('/quotes/{leadType}', LeadForm::class);
    });
