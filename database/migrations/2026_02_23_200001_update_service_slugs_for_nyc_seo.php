<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $updates = [
            'kitchen-remodel' => 'kitchen-remodeling-new-york',
            'bathroom-renovation' => 'bathroom-renovation-new-york',
            'commercial-construction' => 'commercial-construction-manhattan',
        ];

        foreach ($updates as $old => $new) {
            DB::table('services')->where('slug', $old)->update(['slug' => $new]);
        }
    }

    public function down(): void
    {
        $reverts = [
            'kitchen-remodeling-new-york' => 'kitchen-remodel',
            'bathroom-renovation-new-york' => 'bathroom-renovation',
            'commercial-construction-manhattan' => 'commercial-construction',
        ];

        foreach ($reverts as $new => $old) {
            DB::table('services')->where('slug', $new)->update(['slug' => $old]);
        }
    }
};
