<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->decimal('estimated_value', 12, 2)->nullable()->after('estimated_budget');
            $table->decimal('closed_value', 12, 2)->nullable()->after('estimated_value');
            $table->timestamp('closed_at')->nullable()->after('closed_value');
            $table->string('gclid', 100)->nullable()->after('utm_campaign');
            $table->string('fbclid', 100)->nullable()->after('gclid');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['estimated_value', 'closed_value', 'closed_at', 'gclid', 'fbclid']);
        });
    }
};
