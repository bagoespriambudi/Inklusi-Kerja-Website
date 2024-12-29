<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('company_name');
            $table->text('company_description');
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_location');
            $table->string('employment_type'); // full-time, part-time, contract, etc.
            $table->decimal('salary_min', 12, 2)->nullable();
            $table->decimal('salary_max', 12, 2)->nullable();
            $table->string('experience_level'); // entry, mid, senior
            $table->text('requirements');
            $table->text('responsibilities');
            $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade');
            $table->date('deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};