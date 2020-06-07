<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOxfordWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oxford_words', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('en', 50);
            $table->string('ru1', 50);
            $table->string('ru2', 50);
            $table->integer('level_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oxford_words');
    }
}
