<?php

namespace App\Policies;

use App\User;
use App\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy {

    public function view_all (User $user) {
        return true;
    }

    public function view (User $user, Payment $payment) {
        return true;
    }

    public function store (User $user) {
        return true;
    }

    public function destroy (User $user) {
        return true;
    }

}
