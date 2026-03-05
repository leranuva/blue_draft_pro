<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Phase 3: UTM tracking, pipeline stage, follow-up fields.
     */
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('lead_source', 100)->nullable()->after('ip_address');
            $table->string('utm_source', 100)->nullable()->after('lead_source');
            $table->string('utm_medium', 100)->nullable()->after('utm_source');
            $table->string('utm_campaign', 100)->nullable()->after('utm_medium');
            $table->string('stage', 50)->default('new')->after('status');
            $table->timestamp('last_contacted_at')->nullable()->after('stage');
            $table->foreignId('assigned_to')->nullable()->after('last_contacted_at')->constrained('users')->nullOnDelete();
        });

        // Migrate existing status to stage
        \DB::table('quotes')->where('status', 'pending')->update(['stage' => 'new']);
        \DB::table('quotes')->where('status', 'contacted')->update(['stage' => 'contacted']);
        \DB::table('quotes')->where('status', 'completed')->update(['stage' => 'won']);
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropColumn([
                'lead_source', 'utm_source', 'utm_medium', 'utm_campaign',
                'stage', 'last_contacted_at', 'assigned_to',
            ]);
        });
    }
};
