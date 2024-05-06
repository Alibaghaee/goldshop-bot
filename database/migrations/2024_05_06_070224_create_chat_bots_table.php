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
        Schema::create('chat_bots', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chat_id');
            $table->string('chat_first_name');
            $table->string('chat_last_name');
            $table->string('chat_type');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_bots');
    }
};
