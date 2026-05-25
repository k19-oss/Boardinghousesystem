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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('room_number'); // Links the payment to a room
        $table->string('date');        // e.g., 'Oct 25, 2026'
        $table->decimal('amount', 10, 2);
        $table->string('status');      // Paid, Pending, or Overdue
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
