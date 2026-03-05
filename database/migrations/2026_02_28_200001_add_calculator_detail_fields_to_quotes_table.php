<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedInteger('calculator_sqft')->nullable()->after('calculator_budget_max');
            $table->string('calculator_type', 50)->nullable()->after('calculator_sqft');
            $table->string('calculator_borough', 50)->nullable()->after('calculator_type');
            $table->string('calculator_finish_level', 20)->nullable()->after('calculator_borough');
            $table->string('calculator_algorithm_version', 20)->nullable()->after('calculator_finish_level');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn([
                'calculator_sqft',
                'calculator_type',
                'calculator_borough',
                'calculator_finish_level',
                'calculator_algorithm_version',
            ]);
        });
    }
};
