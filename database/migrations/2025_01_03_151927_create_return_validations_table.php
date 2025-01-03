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
        Schema::create('return_validations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('booking_id');
            $table->date('return_date');
            $table->enum('return_condition', ['good', 'damaged']);
            $table->text('return_notes')->nullable();
            $table->string('status')->default('completed');
            $table->uuid('validated_by');
            $table->timestamps();


            $table->foreign('validated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_validations');
    }
};
