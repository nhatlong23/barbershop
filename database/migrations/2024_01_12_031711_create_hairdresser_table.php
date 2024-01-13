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
        Schema::create('hairdresser', function (Blueprint $table) {
            $table->id();
            $table->string('hairdresser_name');
            $table->string('hairdresser_phone');
            $table->string('hairdresser_email');
            $table->text('hairdresser_images');
            $table->boolean('service_status');
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
        Schema::dropIfExists('hairdresser');
    }
};
