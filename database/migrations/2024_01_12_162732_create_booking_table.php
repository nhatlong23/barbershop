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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('booking_name');
            $table->string('booking_phone');
            $table->time('booking_times');
            $table->string('booking_days');
            $table->boolean('booking_quantity');
            $table->integer('booking_branch_id')->index();
            $table->integer('booking_service_id')->index();
            $table->integer('booking_hairdresser_id')->index();
            $table->longText('booking_comment');
            $table->boolean('booking_status');
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
        Schema::dropIfExists('booking');
    }
};
