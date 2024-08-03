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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('address');
            $table->unsignedBigInteger('attire_id');
            $table->dateTime('booked_at');
            $table->text('note')->nullable();
            $table->decimal('total_amount', 15, 2);
            $table->boolean('is_paid')->default(false);
            $table->string('proof')->nullable();
            $table->string('booking_trx_id')->unique();
            $table->timestamps();

            // Menambahkan foreign key constraint untuk attire_id
            $table->foreign('attire_id')->references('id')->on('attires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
