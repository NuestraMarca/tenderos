<?php

use \Illuminate\Database\Seeder;
use Tenderos\Entities\User;
use Tenderos\Entities\Deparment;
use Tenderos\Entities\Municipality;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 'admin_default')->create();
        factory(User::class, 'shopkeeper_default')->create();
        factory(User::class, 'producer_default')->create();

        if(env('APP_ENV') == 'local') {
        	factory(User::class, 'shopkeeper', 10)->create();
        	factory(User::class, 'producer', 10)->create();	
        }
    }
}
