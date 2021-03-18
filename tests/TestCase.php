<?php

declare(strict_types=1);

namespace Roberts\Leads\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Roberts\Leads\LeadsServiceProvider;
use Roberts\Leads\Tests\Support\Providers\NovaTestbenchServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaTestbenchServiceProvider::class,
            LeadsServiceProvider::class,
            SupportServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }
}
