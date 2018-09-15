<?php

namespace App\Observers;

use App\Checklist;

class SortedObserver
{
    public function created($list)
    {
        $list->sort_order = $list->id;
        $list->save();
    }

    public function updated($list)
    {
        //
    }

    public function deleted($list)
    {
        //
    }

    public function restored($list)
    {
        //
    }

    public function forceDeleted($list)
    {
        //
    }
}
