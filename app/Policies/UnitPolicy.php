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
        return true;
    }

    public function section_all (User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the unit.
     *
     * @param  \App\User  $user
     * @param  \App\Unit  $unit
     * @return mixed
     */
    public function view(User $user, Unit $unit) {
        return true;
    }

    /**
     * Determine whether the user can create units.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the unit.
     *
     * @param  \App\User  $user
     * @param  \App\Unit  $unit
     * @return mixed
     */
    public function update(User $user, Unit $unit)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the unit.
     *
     * @param  \App\User  $user
     * @param  \App\Unit  $unit
     * @return mixed
     */
    public function delete(User $user, Unit $unit)
    {
        return true;
    }

    // special policies

        public function view_pets (User $user, Unit $unit) {
            return true;
        }

        public function view_vehicles (User $user, Unit $unit) {
            return true;
        }
}
