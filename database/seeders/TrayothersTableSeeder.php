<?php

namespace Database\Seeders;

use App\Models\Tray\Trayother;
use Illuminate\Database\Seeder;

class TrayothersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trayother::factory()->count(40)->create();
    }
}
