<?php

namespace Roberts\Leads\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Roberts\Leads\Models\LeadBusiness;
use Tipoff\Support\Contracts\Models\UserInterface;

class LeadBusinessPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view lead businesses');
    }

    public function view(UserInterface $user, LeadBusiness $leadBusiness)
    {
        return $user->hasPermissionTo('view lead businesses');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create lead businesses');
    }

    public function update(UserInterface $user, LeadBusiness $leadBusiness)
    {
        return $user->hasPermissionTo('update lead businesses');
    }

    public function delete(UserInterface $user, LeadBusiness $leadBusiness)
    {
        return false;
    }

    public function restore(UserInterface $user, LeadBusiness $leadBusiness)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, LeadBusiness $leadBusiness)
    {
        return false;
    }
}
