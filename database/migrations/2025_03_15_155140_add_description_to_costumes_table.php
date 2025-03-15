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
        Schema::table('costumes', function (Blueprint $table) {
            $table->text('description')->nullable()->after('image'); // Adding a nullable description field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costumes', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};

