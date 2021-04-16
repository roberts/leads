<?php

namespace Roberts\Leads\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Roberts\Leads\Models\LeadStep;
use Tipoff\Support\Contracts\Models\UserInterface;

class LeadStepPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view lead steps');
    }

    public function view(UserInterface $user, LeadStep $leadStep)
    {
        return $user->hasPermissionTo('view lead steps');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create lead steps');
    }

    public function update(UserInterface $user, LeadStep $leadStep)
    {
        return $user->hasPermissionTo('update lead steps');
    }

    public function delete(UserInterface $user, LeadStep $leadStep)
    {
        return false;
    }

    public function restore(UserInterface $user, LeadStep $leadStep)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, LeadStep $leadStep)
    {
        return false;
    }
}
