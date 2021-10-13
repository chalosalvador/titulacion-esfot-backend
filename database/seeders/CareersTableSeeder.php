<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Career::truncate();

        Career::create([
            'name' => 'TSASA'
        ]);
        Career::create([
            'name' => 'TSRT'
        ]);
        Career::create([
            'name' => 'TSDS'
        ]);
        Career::create([
            'name' => 'TSEM'
        ]);
    }
}
