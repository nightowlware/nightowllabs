<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ListItem extends Model
{
    public function checklist() {
        return $this->belongsTo('App\Checklist');
    }

    /**
     * The "boot" method of this model
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('checklist', function (Builder $builder) {
            $builder
                ->join('checklists', 'list_items.checklist_id', '=', 'checklists.id')
                ->where('user_id', '=', \Auth::id());
        });
    }
}
