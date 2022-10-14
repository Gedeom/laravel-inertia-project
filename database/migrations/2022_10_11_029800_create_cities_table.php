<?php

use Database\Seeders\CitySeeder;
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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->char('state_id', 2);
            $table->string('description');
            $table->string('cod_ibge');
            $table->timestamps();

            $table->foreign('state_id','fk_cities_states_state_id')->references('id')->on('states');
        });

        $seeder = new CitySeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
