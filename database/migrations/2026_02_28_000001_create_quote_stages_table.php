<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
            $table->string('stage', 50);
            $table->timestamp('entered_at');
            $table->timestamps();

            $table->index(['quote_id', 'stage']);
        });

        // Backfill: create initial stage record for existing quotes
        $quotes = \DB::table('quotes')->select('id', 'stage', 'updated_at', 'created_at')->get();
        $now = now();
        foreach ($quotes as $q) {
            \DB::table('quote_stages')->insert([
                'quote_id' => $q->id,
                'stage' => $q->stage ?? 'new',
                'entered_at' => $q->updated_at ?? $q->created_at ?? $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_stages');
    }
};
