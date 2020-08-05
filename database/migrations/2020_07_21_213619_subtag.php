<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subtag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('subtag', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->string('name')->unique();
        //     $table->uuid('tag_id');
        //     $table->foreign('tag_id')->references('id')->on('tag');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
