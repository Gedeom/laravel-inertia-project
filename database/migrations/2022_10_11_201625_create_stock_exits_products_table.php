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
        Schema::create('stock_exits_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_exit_id')->references('id')->on('stock_exits')->constrained()->restrictOnDelete();
            $table->foreignId('product_id')->references('id')->on('products')->constrained()->restrictOnDelete();
            $table->decimal('quantity', 15, 2);            
            $table->decimal('price', 15, 2);
            $table->date('exit_date');

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
        Schema::dropIfExists('stock_exits_products');
    }
};
