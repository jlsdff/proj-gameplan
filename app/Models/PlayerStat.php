<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'game_id',
        'points',
        'assists',
        'rebounds',
        'steals',
        'blocks',
        'minutes_played',
        'points_in_paint',
        'second_chance_points',
        'three_pointers_made',
        'three_pointers_attempted',
        'free_throws_made',
        'free_throws_attempted',
        'field_goals_made',
        'field_goals_attempted',
        'offensive_rebounds',
        'defensive_rebounds',
        'turnovers',
        'fouls',
        'personal_fouls',
        'technical_fouls',
        'flagrant_fouls',
        'ejection'
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Players::class, 'player_id', 'id');
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }


}
