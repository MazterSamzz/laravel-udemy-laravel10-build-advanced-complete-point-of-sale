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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->date('date');
            $table->unsignedTinyInteger('status')->default(0);
            $table->decimal('total_products', 16, 2)->default(0);
            $table->decimal('vat', 15, 2)->default(0);
            $table->decimal('total', 16, 2)->default(0);
            $table->unsignedTinyInteger('payment_status')->default(0);
            $table->decimal('paid', 16, 2)->default(0);
            $table->decimal('recieveables', 16, 2)->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
