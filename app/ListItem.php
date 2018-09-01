<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    public function checklist() {
        return $this->belongsTo('App\Checklist');
    }
}
