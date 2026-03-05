<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('cta_text', 255)->nullable()->after('hero_subtitle');
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->string('timeline', 50)->nullable()->after('estimated_budget');
            $table->string('property_type', 50)->nullable()->after('service_type');
            $table->string('calculator_budget_min', 20)->nullable()->after('lead_source');
            $table->string('calculator_budget_max', 20)->nullable()->after('calculator_budget_min');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('cta_text');
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['timeline', 'property_type', 'calculator_budget_min', 'calculator_budget_max']);
        });
    }
};
