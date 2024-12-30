<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('job_listings', 'company_id')) {
                $table->foreignId('company_id')->after('id')->constrained()->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('job_listings', 'job_category_id')) {
                $table->foreignId('job_category_id')->after('company_id')->constrained()->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('job_listings', 'location')) {
                $table->string('location')->after('employment_type');
            }
            
            if (!Schema::hasColumn('job_listings', 'salary_range')) {
                $table->string('salary_range')->after('location');
            }
            
            if (!Schema::hasColumn('job_listings', 'experience_level')) {
                $table->string('experience_level')->after('employment_type');
            }
            
            if (!Schema::hasColumn('job_listings', 'benefits')) {
                $table->text('benefits')->after('requirements');
            }
            
            if (!Schema::hasColumn('job_listings', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('deadline');
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // Drop foreign keys if they exist
            if ($this->hasForeignKey('job_listings', 'job_listings_company_id_foreign')) {
                $table->dropForeign('job_listings_company_id_foreign');
            }
            if ($this->hasForeignKey('job_listings', 'job_listings_job_category_id_foreign')) {
                $table->dropForeign('job_listings_job_category_id_foreign');
            }

            // Drop columns if they exist
            $columns = [
                'company_id',
                'job_category_id',
                'location',
                'salary_range',
                'experience_level',
                'benefits',
                'is_active'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('job_listings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    /**
     * Check if a foreign key exists in a table
     */
    private function hasForeignKey(string $table, string $foreignKey): bool
    {
        $foreignKeys = DB::select(
            "SELECT * FROM information_schema.TABLE_CONSTRAINTS 
            WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [DB::getDatabaseName(), $table, $foreignKey]
        );

        return count($foreignKeys) > 0;
    }
}; 