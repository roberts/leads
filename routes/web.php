<?php

use Illuminate\Support\Facades\Route;
use Roberts\Leads\Http\Livewire\LeadForm;

Route::get('{leadType}', LeadForm::class);
