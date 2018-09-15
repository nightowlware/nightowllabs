<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AmendChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (['checklists', 'list_items'] as $t) {
            Schema::table($t, function (Blueprint $table) {
                $table->integer('sort_order')->default(0);
            });

            // set the order to the id by default
            DB::update('update '.$t.' set sort_order = id');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (['checklists', 'list_items'] as $t) {
            Schema::table($t, function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
}
