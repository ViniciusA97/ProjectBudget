<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Investimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('investimento', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->double('meta_value')->nullable(false);
        //     $table->string('name')->nullable(false);
        //     $table->string('description')->nullable('true');
        //     $table->timestamps();
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
