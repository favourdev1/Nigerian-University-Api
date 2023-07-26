<?php

namespace App\Http\Controllers;

use App\Models\Universities;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $university = Universities::pluck('name');

        return response()->json(["universities"=>$university]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(universities $universities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, universities $universities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(universities $universities)
    {
        //
    }
}