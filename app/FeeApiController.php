<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Fee;
use App\Estate;

class FeeApiController extends Model {
    
	public function __construct () {
		$this->middleware('auth:api');
	}

	public function index ($estate_id) {

		$user = Auth::user();
		$estate = Estate::findOrFail($estate_id);

		if ($user->can('view_all', $estate)) {
			return $estate->fees;
		}

		return response ('Not authorized', 403);

	}

	public function show ($fee_id) {

		$user = Auth::user();
		$fee = Fee::findOrFail($fee_id);

		if ($user->can('view', $fee)) {
			return $fee;
		}

		return redirect ('Not authorized', 403);

	}

	public function store (Request $request) {

		$user = Auth::user();

		if ($user->can('store', App\Fee::class)) {
			$this->validate($request, [
				'estate_id' => 'required|exists:estates,id',
				'name' => 'required|string|max:255',
				'start_date' => 'required|date',
				'charge_every' => 'required|numeric',
				'standard_amount' => 'required|numeric|min:0',
			]);

			$fee = new Fee;
			$fee->estate_id = $request->estate_id;
			$fee->name = $request->name;
			$fee->start_date = $request->start_date;
			$fee->charge_every = $request->charge_every;
			$fee->standard_amount = $request->standard_amount;
			$fee->save();

			return $fee;
		}

		return response ('Not authorized', 403);

	}

	public function destroy ($fee_id) {

		$user = Auth::user();
		$fee = Fee::findOrFail($fee_id);

		if ($user->can('destroy', $fee)) {
			$fee->delete();
			return response ('Deleted', 200);
		}

		return response ('Not authorized', 403);

	}

}
