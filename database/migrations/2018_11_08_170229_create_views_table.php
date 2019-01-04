<?php

use App\User;
use App\Video;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');

            // Connected user
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Video
            $table->string('video_id');
            $table->foreign('video_id')->references('id')->on('videos');

            $table->unique(['user_id', 'video_id']);

            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('time_to_resume')->default(0);

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
        Schema::dropIfExists('user_video');
    }
}
