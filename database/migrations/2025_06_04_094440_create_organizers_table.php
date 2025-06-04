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
        Schema::create('organizers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Kolom user_id bersifat nullable
            $table->string('organization_name');
            $table->text('description')->nullable();
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('logo_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status default adalah pending
            $table->string('email')->unique(); // Tambahkan kolom email untuk validasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizers');
    }
};
