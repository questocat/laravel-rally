<?php

/*
 * This file is part of emanci/laravel-rally package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
            $table->integer('follower_id')->unsigned()->index();
            $table->morphs('followable');
            $table->timestamps();
            $table->foreign('follower_id')
                  ->references('id')
                  ->on(config('rally.follower_table', 'users'))
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
