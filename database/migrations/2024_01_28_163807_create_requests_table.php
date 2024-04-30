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
        Schema::create('requests', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->integer('status_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->text('comment')->nullable();
            $table->string('store');
            $table->dateTime('date_added');
            $table->timestamps();

            $table->index(['order_id', 'store']);
            $table->index(['client_id', 'store']);
            $table->index('date_added');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('requests');
        }
    }
};
