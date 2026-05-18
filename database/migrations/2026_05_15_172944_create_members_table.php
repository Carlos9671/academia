<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->cascadeOnDelete();
            $table->string('name');
            $table->string('phone');
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->tinyInteger('training_days');
            $table->integer('streak_current')->default(0);
            $table->integer('streak_longest')->default(0);
            $table->timestamp('last_checkin_at')->nullable();
            $table->boolean('active')->default(True);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
