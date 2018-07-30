<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EchoPost extends Model {

    public function user() {
        return $this->belongsTo('User');
    }
}
