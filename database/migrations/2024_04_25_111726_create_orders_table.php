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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('payment_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->decimal('subtotal', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('shipping_charge', 8, 2)->nullable();
            $table->decimal('total', 8, 2)->nullable();
            $table->string('status')->nullable();                                
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
        Schema::dropIfExists('orders');
    }
};
