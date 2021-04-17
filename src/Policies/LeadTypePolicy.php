<?php

namespace Roberts\Leads\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Roberts\Leads\Models\LeadType;
use Tipoff\Support\Contracts\Models\UserInterface;

class LeadTypePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view lead types');
    }

    public function view(UserInterface $user, LeadType $leadType)
    {
        return $user->hasPermissionTo('view lead types');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create lead types');
    }

    public function update(UserInterface $user, LeadType $leadType)
    {
        return $user->hasPermissionTo('update lead types');
    }

    public function delete(UserInterface $user, LeadType $leadType)
    {
        return false;
    }

    public function restore(UserInterface $user, LeadType $leadType)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, LeadType $leadType)
    {
        return false;
    }
}
