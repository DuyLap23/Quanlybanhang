<?php

namespace Database\Seeders;

use App\Models\Catelogue as ModelsCatelogue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatelogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       ModelsCatelogue::factory(10)->create();
    }
}
