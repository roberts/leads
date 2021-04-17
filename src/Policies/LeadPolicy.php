<?php

namespace Roberts\Leads\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Roberts\Leads\Models\Lead;
use Tipoff\Support\Contracts\Models\UserInterface;

class LeadPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user)
    {
        return $user->hasPermissionTo('view leads');
    }

    public function view(UserInterface $user, Lead $lead)
    {
        return $user->hasPermissionTo('view leads');
    }

    public function create(UserInterface $user)
    {
        return $user->hasPermissionTo('create leads');
    }

    public function update(UserInterface $user, Lead $lead)
    {
        return $user->hasPermissionTo('update leads');
    }

    public function delete(UserInterface $user, Lead $lead)
    {
        return false;
    }

    public function restore(UserInterface $user, Lead $lead)
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Lead $lead)
    {
        return false;
    }
}
