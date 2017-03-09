<?php

namespace App\Policies;

use App\User;
use App\Estate;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstatePolicy { 

    use HandlesAuthorization;

    /*
        General policy is nobody can see estates that do not belong to their organisation or they are not residents of
        User must either be resident or employee
    */

    public function view_all(User $user) {
        /*
            If user is an employee and has the correct permission
        */
        if ($user->employee && $user->employee->roles->count() > 0 && $user->employee->roles->contains('view_estate', true)) return true;
        return false;
    }

    public function view (User $user, Estate $estate) {
        /*
            If user is employee and user has a role that contains view estate and the estate is included in it's roles
            If the user is a resident and it is part of the estate
        */
        if ($user->employee && $user->employee->roles->count() > 0 && $user->employee->roles->contains('view_estate', true) && $user->employee->estates->contains('estate_id', $estate->id)) return true;
        elseif ($user->resident && $user->resident->estate_id == $estate->id) return true;
        return false;
    }

    public function create(User $user) {
        /*
            if user is employee and user has a role that contains create estate
        */
        if ($user->employee && $user->employee->roles->count() > 0 && $resident->employee->roles->contains('create_estate', true)) return true;
        return false;
    }

    public function update(User $user, Estate $estate) {
        /*
            if user is employee and user has a role that contains edit estate
        */
        if ($user->employee && $user->employee->roles->count() > 0 && $resident->employee->roles->contains('edit_estate', true)) return true;
        return false;
    }

    public function delete(User $user, Estate $estate) {
        /*
            if user is employee and user has a role that contains delete estate
        */
        if ($user->employee && $user->employee->roles->count() > 0 && $resident->employee->roles->contains('delete_estate', true)) return true;
        return false;
    }
}
