<?php

declare(strict_types=1);

namespace Roberts\WorkCompLeads\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Roberts\WorkCompLeads\Tests\Support\Providers\NovaTestbenchServiceProvider;
use Roberts\WorkCompLeads\WorkCompLeadsServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaTestbenchServiceProvider::class,
            WorkCompLeadsServiceProvider::class,
            SupportServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }
}
