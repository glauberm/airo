<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $range = range(18, 70);

        $values = [];

        foreach ($range as $key => $age) {
            $values[$key]['age'] = $age;

            $values[$key]['load'] = match (true) {
                $age > 60 => 1,
                $age > 50 => 0.9,
                $age > 40 => 0.8,
                $age > 30 => 0.7,
                default => 0.6,
            };
        }

        DB::table('ages')->upsert($values, ['age']);
    }
}
