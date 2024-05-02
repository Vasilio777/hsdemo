<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EarthEon;

class EarthController extends Controller
{
    public function index()
    {
        $data = EarthEon::all();
        $data = $data->groupBy('eon');

        $data = $data->map(function ($group, $groupKey) {
            $base = $group->first()->base - $group->first()->duration;
            $baseEnd = $group->last()->base;
    
            $group->transform(function ($item) use ($base, $baseEnd) {
                $item->base = $base;
                $item->base_end = $baseEnd;
                return $item;
            });

            return $group;
        });

        return view('earth_states', compact('data'));
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
        $earthEon = EarthEon::create($request->all());
        
        if ($request->hasFile('img')) {
            $earthEon->addMediaFromRequest('img')->toMediaCollection('images');
        }

        return response()->json($earthEon);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
