<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(
            Players::class,
            PlayerTeamInfo::class,
            'team_id',
            'player_id',
            'id',
            'id'
        );
    }

    public function currentPlayers(): HasManyThrough
    {
        return $this->hasManyThrough(
            Players::class,
            CurrentTeam::class,
            'team_id',
            'id',
            'id',
            'player_id'
        );
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id', 'id')
            ->orWhere('away_team_id', $this->id);
    }
    
}
