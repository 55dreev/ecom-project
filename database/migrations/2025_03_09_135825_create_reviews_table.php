<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Customer's name
            $table->text('comment'); // Comment text
            $table->unsignedBigInteger('parent_id')->nullable(); // For replies
            $table->timestamps();
    
            $table->foreign('parent_id')->references('id')->on('reviews')->onDelete('cascade');
        });
    }
    
};
