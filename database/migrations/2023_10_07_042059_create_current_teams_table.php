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
        Schema::create('current_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("team_id");
            $table->unsignedBigInteger("player_id");
            $table->foreign("player_id")
                    ->references("id")
                    ->on("players")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreign("team_id")
                    ->references('id')
                    ->on("teams")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_teams');
    }
};
