<?php

namespace App\Database\Seeds;

use App\Models\Settings\MaintenanceModel;
use CodeIgniter\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        $maintenance = new MaintenanceModel();
        $maintenance->insert([
            'status' => 0
        ]);
    }
}
