<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFollowablesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('rally.followers_table', 'followables'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('follower_id');
            $table->morphs('followable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('rally.followers_table', 'followables'));
    }
}
