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
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('game_id');
            $table->foreign('player_id')->references('id')->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Personal Stats
            $table->integer('points');
            $table->integer('assists');
            $table->integer('rebounds');
            $table->integer('steals');
            $table->integer('blocks');
            // Shooting Stats
            $table->integer('minutes_played')->nullable();
            $table->integer('points_in_paint');
            $table->integer('second_chance_points');
            $table->integer('three_pointers_made');
            $table->integer('three_pointers_attempted');
            $table->integer('free_throws_made');
            $table->integer('free_throws_attempted');
            // Field Goals
            $table->integer('field_goals_made');
            $table->integer('field_goals_attempted');
            // Rebounds
            $table->integer('offensive_rebounds');
            $table->integer('defensive_rebounds');
            // Turnovers
            $table->integer('turnovers');
            // Fouls
            $table->integer('fouls')->default(0);
            $table->integer('personal_fouls')->default(0);
            $table->integer('technical_fouls')->default(0);
            $table->integer('flagrant_fouls')->default(0);
            $table->integer('ejection')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_stats');
    }
};
