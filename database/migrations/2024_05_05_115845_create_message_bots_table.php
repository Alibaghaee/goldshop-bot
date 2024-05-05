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
        Schema::create('message_bots', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('update_id');
            $table->unsignedBigInteger('message_id');

            $table->unsignedBigInteger('from_id');
            $table->boolean('from_is_bot');
            $table->string('from_first_name');
            $table->string('from_last_name');
            $table->string('from_language_code');

            $table->unsignedBigInteger('chat_id');
            $table->string('chat_first_name');
            $table->string('chat_last_name');
            $table->string('chat_type');
            $table->timestamp('date');
            $table->text('text');


            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_bots');
    }
};
