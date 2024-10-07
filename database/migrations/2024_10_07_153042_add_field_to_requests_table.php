<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('requests', static function (Blueprint $table) {
            $table->unsignedInteger('order_id_ext')
                ->nullable()
                ->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requests', static function (Blueprint $table) {
            $table->dropColumn('order_id_ext');
        });
    }
};
