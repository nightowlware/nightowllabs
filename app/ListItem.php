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
                ->select('text', 'checklist_id', 'list_items.id as id', 'list_items.sort_order as sort_order');
        });
    }

    // Not pretty, but had to override these two methods here since it turns out
    // the queries are not the same for the subclasses.
    public function shiftAsc() {
        $swapWith = self::where($this->getTable() . '.sort_order', '>', $this->sort_order)->
            where('checklist_id', '=', $this->checklist_id)->
            get()->sortBy('sort_order')->first();

        if ($swapWith) {
            $this->swapSortOrder($swapWith);
        }
    }

    public function shiftDesc() {
        $swapWith = self::where($this->getTable() . '.sort_order', '<', $this->sort_order)->
            where('checklist_id', '=', $this->checklist_id)->
            get()->sortBy('sort_order')->last();

        if ($swapWith) {
            $this->swapSortOrder($swapWith);
        }
    }
}
