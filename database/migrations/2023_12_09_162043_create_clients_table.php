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
        Schema::create('clients', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_bad')->default(0);
            $table->string('store', 20);
            $table->timestamps();

            $table->index('name');
        });

        Schema::create('client_contacts', static function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('type');
            $table->string('value')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('client_contacts');
            Schema::dropIfExists('clients');
        }
    }
};
