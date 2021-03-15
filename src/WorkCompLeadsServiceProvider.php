<?php

declare(strict_types=1);

namespace Roberts\WorkCompLeads;

use Tipoff\Support\TipoffPackage;
use Tipoff\Support\TipoffServiceProvider;

class WorkCompLeadsServiceProvider extends TipoffServiceProvider
{
    public function configureTipoffPackage(TipoffPackage $package): void
    {
        $package
            ->name('work-comp-leads')
            ->hasConfigFile();
    }
}
