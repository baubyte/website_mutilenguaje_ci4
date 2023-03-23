<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
	public function run()
	{
		$this->call('MaintenanceSeeder');
		$this->call('UserSeeder');
		$this->call('ArticleSeeder');
		$this->call('TranslationsSeeder');
	}
}
