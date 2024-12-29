<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->text('cover_letter')->nullable();
            $table->string('resume_path');
            $table->enum('status', ['pending', 'reviewing', 'accepted', 'rejected'])->default('pending');
            $table->text('notes')->nullable(); // For admin notes
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            
            // Ensure one user can't apply multiple times to the same job
            $table->unique(['user_id', 'job_listing_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
}; 