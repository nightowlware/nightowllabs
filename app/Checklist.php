<?php

namespace App;

use App\Observers\SortedObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Checklist extends Sortable
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

    public function listItems() {
        return $this->hasMany('App\ListItem')->orderBy('sort_order');
    }

    /**
     * The "boot" method of this model
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', '=', \Auth::id());
        });
    }
}
