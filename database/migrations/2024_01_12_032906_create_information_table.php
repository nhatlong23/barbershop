<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('information_name');
            $table->string('information_title');
            $table->string('information_phone');
            $table->string('information_email');
            $table->boolean('information_status');
            $table->time('information_opening_time');
            $table->time('information_closing_time');
            $table->text('information_images');
            $table->longText('information_mission');
            $table->longText('information_description');
            $table->longText('information_maps');
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
        Schema::dropIfExists('information');
    }
};
