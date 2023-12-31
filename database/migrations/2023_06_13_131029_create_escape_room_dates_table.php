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
        Schema::create('escape_room_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\EscapeRoom::class)->constrained()->cascadeOnDelete();
            $table->date('available_at'); // date
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escape_room_dates');
    }
};
