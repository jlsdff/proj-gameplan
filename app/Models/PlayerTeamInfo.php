<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PlayerTeamInfo extends Model
{
    use HasFactory; 

    protected $fillable = [
        'player_id',
        'team_id',
        'jersey_number',
    ];

    public function players(): BelongsTo
    {
        return $this->belongsTo(Players::class, 'player_id', 'id');
    }
    
}
