<?php

declare(strict_types=1);

namespace Roberts\Leads\Tests;

use Laravel\Nova\NovaCoreServiceProvider;
use Livewire\LivewireServiceProvider;
use Roberts\Leads\LeadsServiceProvider;
use Roberts\Leads\Tests\Support\Models\Phone;
use Spatie\Permission\PermissionServiceProvider;
use Tipoff\Addresses\AddressesServiceProvider;
use Tipoff\Authorization\AuthorizationServiceProvider;
use Tipoff\Statuses\StatusesServiceProvider;
use Tipoff\Support\SupportServiceProvider;
use Tipoff\TestSupport\BaseTestCase;
use Tipoff\TestSupport\Providers\NovaPackageServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            NovaCoreServiceProvider::class,
            NovaPackageServiceProvider::class,
            SupportServiceProvider::class,
            AddressesServiceProvider::class,
            StatusesServiceProvider::class,
            AuthorizationServiceProvider::class,
            PermissionServiceProvider::class,
            LeadsServiceProvider::class,
            LivewireServiceProvider::class,
        ];
    }
}
