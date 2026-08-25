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
        Schema::create('showtimes', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
        $table->foreignId('hall_id')->constrained('halls')->onDelete('cascade');
        $table->dateTime('start_time');
        $table->dateTime('end_time');
        $table->decimal('price', 8, 2);
        $table->string('language')->default('original');
        $table->string('status')->default('scheduled');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
