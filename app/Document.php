<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model {
    
	public function documentable () {
		return $this->morphTo();
	}

	public static function boot () {
		parent::boot();

		static::deleting(function (Document $doc) {
			Storage::delete($doc->path);
		});
	}

}
