<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtractFixed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extract_fixed', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->integer('day_repeat')->nullable(false);
            // $table->string('description')->nullable(false);
            // $table->double('value')->nullable(false);
            // $table->boolean('active')->default(true);
            //$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references("id")->on('users');
        });
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
