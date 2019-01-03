<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');

            $table->text('description');
            $table->string('name');
            $table->string('author');
            $table->date('date');
            $table->string('duration');
            $table->string('source');

            $table->string('photo_urls_size');
            $table->string('photo_urls_url');

            $table->string('color');

            $table->decimal('price',9, 2);
            $table->decimal('business_price',9, 2);

            $table->unsignedBigInteger('views');
            $table->unsignedBigInteger('purchases');

            // Related category
            $table->string('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('videos');
    }
}
