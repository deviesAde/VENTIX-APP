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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('banner_path')->nullable();

            $table->enum('event_type', ['free', 'paid'])->default('free');
            $table->integer('ticket_quantity')->nullable(); // hanya untuk 'paid'
            $table->decimal('ticket_price', 10, 2)->nullable(); // hanya untuk 'paid'

            $table->enum('status', ['draft', 'published'])->default('published');
            $table->enum('category', ['music', 'seminar', 'sports', 'technology', 'art'])->default('music');

            $table->timestamps();

            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
