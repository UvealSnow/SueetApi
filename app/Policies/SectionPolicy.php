<?php

namespace App\Policies;

use App\User;
use App\Estate;
use App\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy {

    use HandlesAuthorization;

    public function view_all(User $user, Estate $estate) {
        if ($user->organisation && $user->organisation->id == $estate->organisation_id) return true; // user is admin of organsiation
        if ($user->resident && $user->resident->estate_id == $estate_id) return true; // user is resident of the property
        if ($user->employee && $user->employee->estates->contains('id', $estate->id)) return $true; // user works in the property
        return false;
    }

    /**
     * Determine whether the user can view the section.
     *
     * @param  \App\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function view(User $user, Estate $estate, Section $section) {
        if ($user->organisation && $user->organisation->id == $estate->organisation_id) return true; // user is admin of organsiation
        if ($user->resident && $user->resident->estate_id == $estate_id) return true; // user is resident of the property
        if ($user->employee && $user->employee->estates->contains('id', $estate->id)) return $true; // user works in the property
        return false;
    }

    /**
     * Determine whether the user can create sections.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        if ($user->employee && $user->employee->roles && $user->employee->roles->contains('edit_state', true)) return $true;
        return false;
    }

    /**
     * Determine whether the user can update the section.
     *
     * @param  \App\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function update(User $user, Estate $estate, Section $section) {
        if  (($user->employee && $user->employee->roles && $user->employee->roles->contains('edit_state', true)) && 
            $section->estate_id = $estate->id) return $true;
        return false;
    }

    /**
     * Determine whether the user can delete the section.
     *
     * @param  \App\User  $user
     * @param  \App\Section  $section
     * @return mixed
     */
    public function delete(User $user, Section $section) {
         if  (($user->employee && $user->employee->roles && $user->employee->roles->contains('edit_state', true)) && 
            $section->estate_id = $estate->id) return $true;
        return false;
    }
}
