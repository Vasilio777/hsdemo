<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EarthEon;
use DOMDocument;
use DOMXPath;

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
        $earthState = EarthEon::findOrFail($id);

        $ch = curl_init();
        $url = "https://en.wikipedia.org/w/api.php?action=parse&format=json&page=" . urlencode($earthState->era);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output, true);

        if (!isset($data['parse']['text']['*'])) {
            return "Error: no content available.";
        }

        $contentHtml = $data['parse']['text']['*'];

        $dom = new DOMDocument();
        @$dom->loadHTML($contentHtml);
        
        $xpath = new DOMXPath($dom);
        foreach ($xpath->query('//sup') as $sup) {
            $sup->parentNode->removeChild($sup);
        }

        $paragraphs = $dom->getElementsByTagName('p');

        if ($paragraphs->length > 1) {
            $era_info = $dom->saveHTML($paragraphs->item(1));
        } else {
            $era_info = "Error: wiki parsing fail.";
        }

        $era_info = strip_tags($era_info);
        
        return view('show_earth_era', [
            'era' => $earthState->era ?? 'Not found.', 
            'age' => $earthState->age ?? 'Not found.',
            'info' => $era_info ?? 'Not found.',
        ]);
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
