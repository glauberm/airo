<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->upsert([
            ['id' => 'EUR'],
            ['id' => 'GBP'],
            ['id' => 'USD'],
        ], ['id']);
    }
}
