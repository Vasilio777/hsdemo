<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EarthEon;
use Illuminate\Support\Facades\File;

class EarthEonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path('resources/csv/slider_data.csv');
        $data = [];
        $durationSum = 0;
        $imageDirectory = public_path('img/eons/');

        if (($handle = fopen($file, 'r')) !== FALSE) {
            fgetcsv($handle, 1000, ","); // skip the header

            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $durationSum += end($row);
                $data[] = $row;
            }
            fclose($handle);

            $prev = 0;
            foreach ($data as &$row) {
                $curr = $row[count($row) - 1];
                $prev += $curr;
                $row[] = $curr;
                $row[] = $prev - $curr / 2;
            }
        }

        foreach ($data as $item) {
            $earthEon = EarthEon::create([
                'eon' => $item[0] ?? null,
                'era' => $item[1] ?? null,
                'period' => $item[2] ?? null,
                'subperiod' => $item[3] ?? null,
                'epoch' => $item[4] ?? null,
                'age' => $item[5] ?? null,
                'base' => $item[6] ?? 0,
                'duration' => $item[7] ?? 0
            ]);

            $imageName = $item[0];
            $imagePath = $this->findImage($imageDirectory, $imageName);

            if ($imagePath) {
                $earthEon->addMedia($imagePath)->toMediaCollection('images');
            }
        }
    }

    private function findImage($directory, $imageName)
    {
        $files = File::glob($directory . $imageName . '.*');
        return count($files) > 0 ? $files[0] : null;
    }
}
