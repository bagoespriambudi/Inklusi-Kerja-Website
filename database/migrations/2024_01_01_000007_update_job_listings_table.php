<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['category_id']);
            
            // Drop unused columns
            $table->dropColumn([
                'salary_min',
                'salary_max',
                'responsibilities',
                'category_id'
            ]);

            // Add new columns
            $table->string('salary_range')->after('employment_type');
            $table->foreignId('job_category_id')->after('company_id')->constrained()->onDelete('cascade');
            $table->text('benefits')->after('requirements');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['job_category_id']);
            
            // Restore original columns
            $table->decimal('salary_min', 12, 2)->nullable()->after('employment_type');
            $table->decimal('salary_max', 12, 2)->nullable()->after('salary_min');
            $table->text('responsibilities')->after('requirements');
            $table->foreignId('category_id')->after('responsibilities')->constrained('job_categories')->onDelete('cascade');

            // Drop new columns
            $table->dropColumn([
                'salary_range',
                'job_category_id',
                'benefits'
            ]);
        });
    }
}; 