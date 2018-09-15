<?php

namespace App;

use App\Observers\SortedObserver;
use Illuminate\Database\Eloquent\Model;

abstract class Sortable extends Model
{
    public function shiftAsc() {
        $swapWith = self::where('sort_order', '>', $this->sort_order)->get()->sortBy('sort_order')->first();
        if ($swapWith) {
            $this->swapSortOrder($swapWith);
        }
    }

    public function shiftDesc() {
        $swapWith = self::where('sort_order', '<', $this->sort_order)->get()->sortBy('sort_order')->last();
        if ($swapWith) {
            $this->swapSortOrder($swapWith);
        }
    }

    public function swapSortOrder($that) {
        $temp = $this->sort_order;
        $this->sort_order = $that->sort_order;
        $that->sort_order = $temp;

        $this->save();
        $that->save();
    }

    /**
     * The "boot" method of this model
     */
    protected static function boot() {
        static::observe(new SortedObserver());
    }
}
