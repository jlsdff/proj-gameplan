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
        Schema::create('player_team_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('jersey_number')->nullable();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_id');
            $table->foreign('player_id')
                ->references('id')
                ->on('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
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
        Schema::dropIfExists('player_team_infos');
    }
};
