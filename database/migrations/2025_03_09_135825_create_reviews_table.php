<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('comment');
            $table->unsignedBigInteger('costume_id'); // Add costume_id column
            $table->foreign('costume_id')->references('id')->on('costumes')->onDelete('cascade'); // Foreign key
            $table->foreignId('parent_id')->nullable()->constrained('reviews')->onDelete('cascade'); // Replies
            $table->integer('rating')->default(0); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
