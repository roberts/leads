<?php

namespace Roberts\Leads\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Roberts\Leads\Models\LeadField;
use Tipoff\Support\Contracts\Models\UserInterface;

class LeadFieldPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view lead fields');
    }

    public function view(UserInterface $user, LeadField $leadField)
    {
        return $user->hasPermissionTo('view lead fields');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create lead fields');
    }

    public function update(UserInterface $user, LeadField $leadField)
    {
        return $user->hasPermissionTo('update lead fields');
    }

    public function delete(UserInterface $user, LeadField $leadField)
    {
        return false;
    }

    public function restore(UserInterface $user, LeadField $leadField)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, LeadField $leadField)
    {
        return false;
    }
}
