<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $guarded = [
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
