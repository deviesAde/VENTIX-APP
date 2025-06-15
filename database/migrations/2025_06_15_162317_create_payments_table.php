<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_registration_id')->constrained()->onDelete('cascade');
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending');
            $table->string('transaction_id')->nullable(); // Bisa juga 'transaction_id' atau 'snap_token' sesuai kebutuhan
            $table->decimal('amount', 10, 2)->nullable(); // Tambahkan ini jika menyimpan total pembayaran
            $table->string('snap_token')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
}

