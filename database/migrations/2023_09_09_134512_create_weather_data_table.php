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
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('lat');
            $table->string('lon');
            $table->string('condition');
            $table->decimal('temperature', 5, 2)->index();
            $table->decimal('feels_like', 5, 2);
            $table->integer('humidity')->index();
            $table->decimal('wind_speed', 5, 2)->index();
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
        Schema::dropIfExists('weather_data');
    }
};
