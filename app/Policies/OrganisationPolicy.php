<?php

namespace App\Policies;

use App\User;
use App\Organisation;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganisationPolicy {
    use HandlesAuthorization;

    public function view(User $user, Organisation $organisation) {
        // if ($user->employee && $user->employee->organisation_id == $organisation->id) return true;
        return true;
    }

    public function update(User $user, Organisation $organisation) {
        // if ($user->organisation && $user->organisation->id == $organisation->id) return true;
        return true;
    }

    public function delete(User $user, Organisation $organisation) {
        // if ($user->organisation->id == $organisation->id) return true;
        return true;
    }
}
