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
        Schema::create('trackings', static function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('type');
            $table->string('number');
            $table->dateTime('delivered')->nullable();
            $table->dateTime('received')->nullable();
            $table->dateTime('canceled')->nullable();
            $table->boolean('expired')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
