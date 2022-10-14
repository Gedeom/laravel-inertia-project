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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('doc',14);
            $table->date('birth_date')->nullable();
            $table->date('opening_date')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->string('email', 50);
            $table->string('phone_number', 20)->nullable();
            $table->string('mobile_number', 20)->nullable();
            $table->foreignId('city_id')->references('id')->on('cities')->constrained()->restrictOnDelete();
            $table->string('zip_code', 8);
            $table->string('address');
            $table->string('district');
            $table->string('adress_number', 10);
            $table->string('complement')->nullable();
            $table->timestamps();

            $table->foreignId('user_id_created')->nullable()->references('id')->on('users')->constrained()->restrictOnDelete();
            $table->foreignId('user_id_updated')->nullable()->references('id')->on('users')->constrained()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
};
