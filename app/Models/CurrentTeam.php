<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrentTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        "team_id",
        "player_id"
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Players::class, 'player_id');
    }
    
}
