<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EarthController extends Controller
{
    public function index()
    {
        $file = '../resources/csv/slider_data.csv';
        $data = [];
        $durationSum = 0;
        
        if (($handle = fopen($file, 'r')) !== FALSE) {
            fgetcsv($handle, 1000, ","); // skip header
            
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $durationSum += end($row);
                $data[] = $row;
            }
            fclose($handle);

            foreach ($data as &$row) {
                $row[] = $row[count($row) - 1] / $durationSum;
            }
        }

        $data = collect($data)->groupBy(function ($item, $key) {
            return $item[0];
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
        //
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
