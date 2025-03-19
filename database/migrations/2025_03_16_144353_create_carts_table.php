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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // If login is not required
            $table->unsignedBigInteger('costume_id'); // References costumes
            $table->integer('quantity')->default(1);
            $table->integer('days')->default(1);
            $table->decimal('unit_price', 10, 2); // Added unit price column
            $table->decimal('total_price', 10, 2);
            $table->string('cart_token')->nullable(); // Added cart token column
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('costume_id')->references('id')->on('costumes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
