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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('role')->nullable()->after('desc');
            $table->text('overview')->nullable()->after('role');
            $table->text('problem')->nullable()->after('overview');
            $table->text('solution')->nullable()->after('problem');
            $table->text('contribution')->nullable()->after('solution');
            $table->json('features')->nullable()->after('contribution');
            $table->string('result_headline')->nullable()->after('features');
            $table->text('result_summary')->nullable()->after('result_headline');
            $table->json('result_metrics')->nullable()->after('result_summary');
            $table->json('gallery')->nullable()->after('result_metrics');
            $table->string('github_url')->nullable()->after('gallery');
            $table->string('live_url')->nullable()->after('github_url');
            $table->string('documentation_url')->nullable()->after('live_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'role',
                'overview',
                'problem',
                'solution',
                'contribution',
                'features',
                'result_headline',
                'result_summary',
                'result_metrics',
                'gallery',
                'github_url',
                'live_url',
                'documentation_url',
            ]);
        });
    }
};
