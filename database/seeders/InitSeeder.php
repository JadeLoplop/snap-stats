<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Platform;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            [
                "GB",
                "United Kingdom",
            ],
            [
                "ID",
                "Indonesia",
            ],
            [
                "IN",
                "India",
            ],
            [
                "KR",
                "South Korea",
            ],
            [
                "RU",
                "Russia",
            ],
            [
                "US",
                "United States",
            ],
        ];

        foreach ($countries as $country) {
            Country::create([
                'iso' => $country[0],
                'name' => $country[1],
            ]);
        }

        $platforms = [
            "iPhone",
            "iPad",
            "Android",
            "Other",
        ];

        foreach ($platforms as $platform) {
            Platform::create([
                'name' => $platform,
            ]);
        }

        $publishers = [
            "Mickey Mouse",
            "Minnie Mouse",
            "Donald Duck",
            "Goofy",
            "Ariel",
            "Stitch",
            "Cinderella",
            "Peter Pan",
            "Mulan",
            "Pocahontas",
            "Snow White",
            "Buzz",
            "Woody",
            "Aladdin",
            "Captain Hook",
        ];

        foreach ($publishers as $publisher) {
            Publisher::create([
                'name' => $publisher,
            ]);
        }
    }
}
