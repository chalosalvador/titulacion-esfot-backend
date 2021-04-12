<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Careers;

class CareersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Careers::truncate();

        Careers::create([
            'name' => 'ASI'
        ]);
        Careers::create([
            'name' => 'ASA'
        ]);
        Careers::create([
            'name' => 'ET'
        ]);
        Careers::create([
            'name' => 'EM'
        ]);
        Careers::create([
            'name' => 'TSEM'
        ]);
        Careers::create([
            'name' => 'TSDS'
        ]);
        Careers::create([
            'name' => 'TSASA'
        ]);
        Careers::create([
            'name' => 'TSET'
        ]);

    }
}
