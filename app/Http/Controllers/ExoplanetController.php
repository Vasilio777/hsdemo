<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exoplanet;

class ExoplanetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('exoplanets');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Exoplanet $exoplanet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exoplanet $exoplanet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exoplanet $exoplanet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exoplanet $exoplanet)
    {
        //
    }
}
