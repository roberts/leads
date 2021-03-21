<?php

declare(strict_types=1);

namespace Roberts\Leads\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Roberts\Leads\LeadsServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Statuses\StatusesServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaTestbenchServiceProvider::class,
            SupportServiceProvider::class,
            StatusesServiceProvider::class,
            AuthorizationServiceProvider::class,
            PermissionServiceProvider::class,
            LivewireServiceProvider::class,
            LeadsServiceProvider::class,
        ];
    }
}
