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
        Schema::create('escape_room_times', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\EscapeRoomDate::class)->constrained()->cascadeOnDelete();
            $table->integer('capacity'); // participant
            $table->time('begin');
            $table->time('end');
            $table->integer('price');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escape_room_times');
    }
};
