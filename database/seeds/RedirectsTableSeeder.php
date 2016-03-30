<?php

use Illuminate\Database\Seeder;
use Nightwing\Models\Redirect;

class RedirectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redirect::create(['path' => 'cgg', 'target' => 'http://www.celebsgonegood.org/', 'http_status' => 301]);
    }
}
