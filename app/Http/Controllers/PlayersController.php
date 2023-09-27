<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Players::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'birthDate' => 'date',
        ]);

        $player = Players::create([
            'firstName' => $fields['firstName'],
            'lastName' => $fields['lastName'],
        ]);

        return response($player, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Players::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $player = Players::find($id);

        if(!$player) {
            return response([
                'message' => 'Player not found'
            ], 404);
        }

        $player->update($request->all());

        return $player;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Players::destroy($id);
    }
}
