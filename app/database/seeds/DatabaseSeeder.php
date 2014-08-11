<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		echo "Select seeder in DatabaseSeeder.php";

        // $this->call('SeederName');
	}

}