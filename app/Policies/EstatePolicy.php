<?php

namespace App\Policies;

use App\User;
use App\Estate;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstatePolicy { 

    use HandlesAuthorization;

    public function view_all(User $user) {
        return true;
        // if ($user->organisation || ($user->employee && $user->employee->estates)) return true;
        // return false;
    }

    public function view(User $user, Estate $estate) {
        // if  ($estate != null && 
        //     (($user->employee && 
        //     $user->employee->organisation_id == $estate->organisation_id) || 
        //     ($user->resident && 
        //     $user->resident->estate->id == $estate->id))) return true;
        return true;
    }

    public function create(User $user) {
        // if ($user->employee && $user->employee->roles->contains('create_estates', true)) return true;
        return true;
    }

    public function update(User $user, Estate $estate) {
        // if  ($user->employee && 
        //     $estate != null &&
        //     $user->employee->organisation_id == $estate->organisation_id &&
        //     $user->employee->roles->contains('edit_estates', true)) return true;
        return true;
    }

    public function delete(User $user, Estate $estate) {
        // if ($user->organisation->id == $estate->organisation_id) return true;
        return true;
    }
}
