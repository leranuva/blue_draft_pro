<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->decimal('internal_cost_estimate', 12, 2)->nullable()->after('estimated_value');
            $table->decimal('expected_margin', 12, 2)->nullable()->after('internal_cost_estimate');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['internal_cost_estimate', 'expected_margin']);
        });
    }
};
