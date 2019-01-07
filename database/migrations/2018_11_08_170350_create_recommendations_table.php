<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->increments('id');

            // Origin user
            $table->unsignedInteger('origin_user_id');
            $table->foreign('origin_user_id')->references('id')->on('users');

            // Target user
            $table->unsignedInteger('target_user_id');
            $table->foreign('target_user_id')->references('id')->on('users');

            // Video
            $table->string('video_id');
            $table->foreign('video_id')->references('id')->on('videos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('recommendations');
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
