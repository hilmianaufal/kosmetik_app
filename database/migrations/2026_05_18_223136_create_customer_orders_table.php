<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('customer_orders', function (Blueprint $table) {
        $table->id();

        $table->string('customer_name');
        $table->string('customer_phone');

        $table->text('customer_address');

        $table->integer('total');

        $table->string('status')->default('pending');

        $table->string('payment_method')->default('qris');

        $table->string('payment_proof')->nullable();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};
