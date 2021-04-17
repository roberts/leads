  
<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddLocationPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view leads' => ['Owner', 'Executive', 'Staff'],
            'create leads' => ['Owner', 'Executive'],
            'update leads' => ['Owner', 'Executive'],
            'view lead businesses' => ['Owner', 'Executive', 'Staff'],
            'create lead businesses' => ['Owner', 'Executive'],
            'update lead businesses' => ['Owner', 'Executive'],
            'view lead fields' => ['Owner', 'Executive', 'Staff'],
            'create lead fields' => ['Owner', 'Executive'],
            'update lead fields' => ['Owner', 'Executive'],
            'view lead steps' => ['Owner', 'Executive', 'Staff'],
            'create lead steps' => ['Owner', 'Executive'],
            'update lead steps' => ['Owner', 'Executive'],
            'view lead types' => ['Owner', 'Executive', 'Staff'],
            'create lead types' => ['Owner', 'Executive'],
            'update lead types' => ['Owner', 'Executive'],
        ];

        $this->createPermissions($permissions);
    }
}
