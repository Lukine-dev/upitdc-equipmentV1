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
        Schema::create('release_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');

            $table->text('purpose'); // added this to describe reason for request
            $table->date('release_date'); // renamed from date_requested for clarity
            $table->date('date_approved')->nullable();
            $table->date('date_returned')->nullable();

            $table->string('pr_number')->nullable();
            $table->text('remarks')->nullable();

            $table->enum('status', ['pending', 'approved', 'returned', 'declined'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('release_requests');
    }
};
