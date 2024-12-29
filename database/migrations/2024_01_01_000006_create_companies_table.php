<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->string('location');
            $table->string('industry')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        // Modify job_listings table to reference companies
        Schema::table('job_listings', function (Blueprint $table) {
            // Drop existing company columns
            $table->dropColumn([
                'company_name',
                'company_description',
                'company_logo',
                'company_website',
                'company_location'
            ]);

            // Add company_id foreign key
            $table->foreignId('company_id')->after('id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Restore original job_listings columns
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
            
            $table->string('company_name');
            $table->text('company_description');
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_location');
        });

        Schema::dropIfExists('companies');
    }
}; 