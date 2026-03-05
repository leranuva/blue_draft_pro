<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_email_sequence_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('email_number'); // 1-6
            $table->timestamp('sent_at');
            $table->timestamps();
            $table->unique(['quote_id', 'email_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_email_sequence_log');
    }
};
