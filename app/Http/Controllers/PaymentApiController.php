<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Payment;
// use App\

class PaymentApiController extends Controller {
    
	public function __construct () {
		$this->middleware('auth:api');
	}

	public function index ($unit_id = null, $user_id = null) {

		$user = Auth::user();

		if ($unit_id != null) $unit = Unit::findOrFail($unit_id);
		elseif ($unit_id != null) $resident = User::findOrFail($user_id);

		if ($user->can('view_all', App\Payment::class)) {

		}

		return response ('Not authorized', 403);

	}

	public function show ($payment_id) {

		$user = Auth::user();
		$payment = Payment::findOrFail($payment_id);

		if ($user->can('view', $payment)) {
			return $payment;
		}

		return response ('Not authorized', 403);

	}

	public function store (Request $request, $unit_id) {

		$user = Auth::user();
		$unit = Unit::findOrFail($unit_id);

		if ($user->can('store', App\Payment::class)) {
			$this->validate($request, [
				// 
			]);	



		}

		return response ('Not authorized', 403);

	}

	public function destroy ($payment_id) {

		$user = Auth::user();
		$payment = Payment::findOrFail($payment_id);

		if ($user->can('destroy', $payment)) {
			return response ('Deleted', 200);
		}

	}

}
