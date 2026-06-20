<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('countries')) {
            return;
        }

        $countries = [
            ['name' => 'Nepal', 'code' => 'NPL'],
            ['name' => 'India', 'code' => 'IND'],
            ['name' => 'United States', 'code' => 'USA'],
            ['name' => 'United Kingdom', 'code' => 'GBR'],
            ['name' => 'Australia', 'code' => 'AUS'],
        ];

        foreach ($countries as $country) {
            Country::query()->firstOrCreate(
                ['code' => $country['code']],
                ['name' => $country['name']],
            );
        }
    }
}
