<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game_stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'home_team_score',
        'away_team_score'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
    
    
}
