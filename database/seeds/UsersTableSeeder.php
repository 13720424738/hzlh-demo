<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = require 'UserData.php';

        foreach ($userData as $value) {
            $user = factory(Modules\User\Entities\User\User::class)->make();
            $user->cellphone = $value['cellphone'];
            $user->password = $value['password'];
            $user->avatar = $value['avatar'];
            $user->save();
        }
    }
}
