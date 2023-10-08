<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'date',
        'location'
    ];
    
    public function home_team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id', 'id');
    }

    public function away_team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id', 'id');
    }

    public function game_stat(): HasOne
    {
        return $this->hasOne(Game_stat::class, 'game_id', 'id');
    }

    public function player_stats(): HasMany
    {
        return $this->hasMany(PlayerStat::class, 'game_id', 'id');
    }
    
}
