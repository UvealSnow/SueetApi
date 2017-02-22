<?php

namespace App\Policies;

use App\Fee;
use App\User;
use App\Estate;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeePolicy {
    use HandlesAuthorization;

    public function view_all (User $user, Estate $estate) {
        return true;
    }

    public function view (User $view) {
        return true;
    }

    public function create (User $user) {
        return true;
    }

    public function destroy (User $user, Fee $fee) {
        return true;
    }

}
