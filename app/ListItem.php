<?php

namespace App;

use App\Observers\SortedObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ListItem extends Sortable
{
    public $timestamps = false;

    protected $fillable = [
        'text',
        'checklist_id'
    ];

    public function checklist() {
        return $this->belongsTo('App\Checklist');
    }

    public function setText(string $text) {
        $this->text = substr($text, 0, 4000);
    }

    /**
     * The "boot" method of this model
     */
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('checklist', function (Builder $builder) {
            $builder
                ->join('checklists', 'list_items.checklist_id', '=', 'checklists.id')
                ->where('user_id', '=', \Auth::id())
                ->select('text', 'checklist_id', 'list_items.id as id');
        });
    }
}
