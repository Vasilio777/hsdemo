<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Http\Requests\StoreExperimentRequest;
use App\Http\Requests\UpdateExperimentRequest;

class ExperimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreExperimentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Experiment $experiment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experiment $experiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperimentRequest $request, Experiment $experiment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experiment $experiment)
    {
        //
    }
}
