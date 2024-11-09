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
        Schema::create('document_validations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('booking_id');
            $table->enum('document_type', ['ktp_booking', 'identity_booking', 'selfie_booking']); // Types will be restricted to these
            $table->string('status')->default('PENDING'); // APPROVED, REJECTED, or PENDING
            $table->text('rejection_reason')->nullable(); // Reason for rejection
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_validations');
    }
};
