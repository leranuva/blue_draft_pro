<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            return; // SQLite no soporta MODIFY; longitud no se aplica en tests
        }
        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE posts ALTER COLUMN meta_title TYPE VARCHAR(500)');
            DB::statement('ALTER TABLE posts ALTER COLUMN meta_description TYPE VARCHAR(500)');
        } else {
            DB::statement('ALTER TABLE posts MODIFY meta_title VARCHAR(500) NULL');
            DB::statement('ALTER TABLE posts MODIFY meta_description VARCHAR(500) NULL');
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();
        if ($driver === 'sqlite') {
            return;
        }
        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE posts ALTER COLUMN meta_title TYPE VARCHAR(255)');
            DB::statement('ALTER TABLE posts ALTER COLUMN meta_description TYPE VARCHAR(255)');
        } else {
            DB::statement('ALTER TABLE posts MODIFY meta_title VARCHAR(255) NULL');
            DB::statement('ALTER TABLE posts MODIFY meta_description VARCHAR(255) NULL');
        }
    }
};
