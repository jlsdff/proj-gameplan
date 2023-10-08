<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Players extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'birthDate',
    ];

    public function teams(): HasManyThrough
    {
        return $this->hasManyThrough(
            Team::class,
            PlayerTeamInfo::class,
            'player_id',
            'id',
            'id',
            'team_id'
        );
    }

    public function currentTeam(): HasOneThrough
    {
        return $this->hasOneThrough(
            Team::class,
            CurrentTeam::class,
            'player_id',
            'id',
            'id',
            'id'
        );
    }

    public function playerStats(): HasMany
    {
        return $this->hasMany(PlayerStat::class, 'player_id', 'id');
    }

}
