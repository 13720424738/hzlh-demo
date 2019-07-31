<?php

use Illuminate\Database\Seeder;

class CrewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $crewData = require 'CrewData.php';

        foreach ($crewData as $value) {
            $crew = factory(Modules\Crew\Entities\Crew\Crew::class)->make();
            $crew->username = $value['username'];
            $crew->password = $value['password'];
            $crew->avatar = $value['avatar'];
            $crew->save();
        }
    }
}
