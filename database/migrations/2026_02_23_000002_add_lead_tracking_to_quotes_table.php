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
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedSmallInteger('lead_score')->default(0)->after('step');
            $table->timestamp('abandoned_at')->nullable()->after('lead_score');
            $table->string('source_url', 500)->nullable()->after('abandoned_at');
            $table->string('user_agent', 500)->nullable()->after('source_url');
            $table->string('ip_address', 45)->nullable()->after('user_agent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['lead_score', 'abandoned_at', 'source_url', 'user_agent', 'ip_address']);
        });
    }
};
