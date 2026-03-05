<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('utm_content', 100)->nullable()->after('utm_campaign');
            $table->timestamp('first_contacted_at')->nullable()->after('last_contacted_at');
            $table->timestamp('proposal_sent_at')->nullable()->after('first_contacted_at');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['utm_content', 'first_contacted_at', 'proposal_sent_at']);
        });
    }
};
