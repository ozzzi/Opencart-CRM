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
        Schema::create('orders', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id', false, true);
            $table->string('store', 20);
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->string('shipping_city');
            $table->string('shipping_zone');
            $table->text('comment');
            $table->decimal('total', 15, 2);
            $table->integer('status_id');
            $table->dateTime('date_added');
            $table->timestamps();

            $table->index('phone');
            $table->index('name');
        });

        Schema::create('order_products', static function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('product_id', false, true);
            $table->string('name');
            $table->string('model');
            $table->integer('quantity');
            $table->decimal('price', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('order_products');
            Schema::dropIfExists('orders');
        }
    }
};
