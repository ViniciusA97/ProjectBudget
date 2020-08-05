<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Extract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extract', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('value')->nullable(false);
            $table->dateTime('date')->nullable(false);;
            $table->string('description')->nullable(false);;
            $table->uuid('user_id')->unsigned()->nullable('false');
            $table->foreign('user_id')->references('id')->on('users');            
            $table->uuid('subtag_id')->unsigned()->nullable();
            $table->foreign('subtag_id')->references('id')->on('subtag');
            $table->uuid('investimento_id')->unsigned()->nullable('true');
            $table->foreign('investimento_id')->references('id')->on('investimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extract');
    }
}
