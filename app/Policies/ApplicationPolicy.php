<?php

namespace App\Policies;

use App\User;
use App\Estate;
use App\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy {
    use HandlesAuthorization;


    public function view_all (User $user, Estate $estate) {
        return true;
    }

    public function view (User $user, Application $application) {
        return true;
    }

    public function create (User $user) {
        return true;
    }

    public function answer (User $user, Application $application) {
        return true;
    }

    public function destroy (User $user, Application $application) {
        return true;
    }  

}
