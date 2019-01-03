<?php

use App\User;
use App\Video;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');

            // Connected user
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // Video
            $table->string('video_id');
            $table->foreign('video_id')->references('id')->on('videos');

            $table->string('stripe_token');

            $table->timestamps();
        });
    }
}
