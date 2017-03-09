<?php

namespace App\Policies;

use App\User;
use App\Unit;
use App\Estate;
use App\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnitPolicy {
    use HandlesAuthorization;

    public function estate_all (User $user) {
        /*
            Checks if user is an employee and has the right permissions 
        */
        if ($this->isEmployee($user) && $user->employee->roles->contains('view_estate', true) && $user->employee->roles->contains('view_unit', true)) return true;
        return ralse;
    }

    public function section_all (User $user) {
        /*
            Checks if user is an employee and has the right permissions 
        */
        if ($this->isEmployee($user) && $user->employee->roles->contains('view_section', true) && $user->employee->roles->contains('view_unit', true)) return true;
        return ralse;
    }

    public function view (User $user, Unit $unit) {
        if ($this->isEmployee($user)) {
            if ($this->belongsToUnit($user)) return true;
        }
        return false;
    }

    public function create (User $user, Estate $estate) {
        if ($this->isEmployee($user)) {
            if ($this->belongsToEstate($user, $estate)) {
                if ($user->employee->roles->contains('create_unit', true))
            }
        }
        return false;
    }

    public function update(User $user, Unit $unit) {
        return true;
    }

    public function delete(User $user, Unit $unit) {
        return true;
    }

    // special policies

        public function view_pets (User $user, Unit $unit) {
            return true;
        }

        public function view_vehicles (User $user, Unit $unit) {
            return true;
        }

    // redundant methods

        public function isEmployee (User $user) {
            if ($user->employee) {
                if ($user->employee->roles->count() > 0) return true;
            }
            return false;
        }

        public function isResident (User $user, Estate $estate) {
            if ($user->resident) {
                if ($this->belongsToEstate($user, $estate)) return true;
            }
            return false;
        }

        public function belongsToEstate (User $user, Estate $estate, $permission = null) {
            if ($this->isEmployee($user)) {
                foreach ($user->employee->roles as $role) {
                    if ($role->pivot->estate_id == $estate->id) {
                        if ($permission != null && $role->contains($permission, true)) return true;
                        elseif ($permission == null) return true;
                    }
                }
            }
            elseif ($user->resident->estate_id == $estate->id) return true;
            return false;
        }
}
