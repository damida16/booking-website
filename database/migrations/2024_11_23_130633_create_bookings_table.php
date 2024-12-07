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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Reference to users table
            $table->string('sales'); // Salesperson responsible
            $table->string('presales')->nullable(); // Optional presales info
            $table->string('customer'); // Customer name or identifier
            $table->dateTime('start_book'); // Booking start time
            $table->dateTime('end_book'); // Booking end time
            $table->text('notes')->nullable(); // Optional notes
            $table->string('status');
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};