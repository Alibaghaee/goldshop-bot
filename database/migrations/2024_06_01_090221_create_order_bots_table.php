<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_bots', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('item');
            $table->string('price')->nullable();
            $table->string('count')->nullable();
            $table->string('weight')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_bots');
    }
};
