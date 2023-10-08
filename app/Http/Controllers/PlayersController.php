<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Http\Controllers\Controller;
use App\Models\CurrentTeam;
use App\Models\PlayerTeamInfo;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $players = Players::all()->load('teams')->load('currentTeam');

        return $players;

        // return Players::all()->pluck();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate Request
        $fields = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'team_id' => 'required|integer',
            'birthDate' => 'date',
            'jersey_number' => 'integer',
        ]);

        // Check if Player already exists
        $player = Players::where('firstName', $fields['firstName'])
            ->where('lastName', $fields['lastName'])
            ->first();
        if (
            $player
        ) {
            return response([
                'message' => 'Player already exists',
                'player' => $player,
            ], 409);
        }
        // Check Team if exists
        if (!Team::find($fields['team_id'])) {
            return response([
                'message' => 'Team not found',
            ], 404);
        }

        // Create Player
        $player = Players::create([
            'firstName' => $fields['firstName'],
            'lastName' => $fields['lastName'],
            'birthDate' => $fields['birthDate'] ?? null,
        ]);

        // Create PlayerTeamInfo
        PlayerTeamInfo::create([
            'player_id' => $player->id,
            'team_id' => $fields['team_id'],
            'jersey_number' => $fields['jersey_number'] ?? null,
        ]);

        // Create CurrentTeam
        CurrentTeam::create([
            'player_id' => $player->id,
            'team_id' => $fields['team_id'],
        ]);

        // Return Response
        $response = [
            'player' => $player,
            'team' => Team::find($fields['team_id']),
            'jersey_number' => $fields['jersey_number'] ?? null,
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $player = Players::find($id);

        if (!$player) {
            return response([
                'message' => "Player not found"
            ], 404);
        };

        $player->teams;
        $player->currentTeam;
        $player->playerStats;

        return $player;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $player = Players::find($id);

        if (!$player) {
            return response([
                'message' => 'Player not found'
            ], 404);
        }

        $player->update($request->all());

        CurrentTeam::where('player_id', $id)->update([
            'team_id' => $request->team_id
        ]);

        $playerTeamInfo = PlayerTeamInfo::where([
            "player_id" => $id,
            "team_id" => $request->team_id
        ])->exists();

        if ($playerTeamInfo) {
            PlayerTeamInfo::where([
                'player_id' => $id,
                'team_id' => $request->team_id
            ])->update([
                'jersey_number' => $request->jersey_number ?? null
            ]);
        } else {
            PlayerTeamInfo::create([
                'player_id' => $id,
                'team_id' => $request->team_id,
                'jersey_number' => $request->jersey_number ?? null
            ]);
        }

        $response = [
            "player" => $player,
            "team" => Team::find($request->team_id),
            // "jersey_number" => $request->jersey_number ?? null,
            // for test
            "playerTeamInfo" => PlayerTeamInfo::where([
                "player_id" => $id,
                "team_id" => $request->team_id
            ])->first(),
            "currentTeam" => CurrentTeam::where('player_id', $id)->first()
        ];


        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Players::destroy($id);
    }
}
