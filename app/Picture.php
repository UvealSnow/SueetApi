<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model {
    
	public function picturable () {
		return $this->morphTo();
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Picture $picture) {
			Storage::delete($picture->path);
		});
	}

}
