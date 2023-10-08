<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Team::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
        ]);

        $team = Team::create([
            'name' => $fields['name'],
        ]);

        return response($team, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $team = Team::find($id);

        return $team ?? response([
            'message' => 'Team not found'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $team = Team::find($id);

        if(!$team) {
            return response([
                'message' => 'Team not found'
            ], 404);
        }

        $team->update($request->all());

        return response($team, 200);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return Team::find($id)->delete();
    }
}
