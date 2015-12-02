<?php


use \Illuminate\Database\Seeder;
use Education\Entities\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 'admin_default')->create();
        factory(User::class, 'shopkeeper_default')->create();
        factory(User::class, 'producer_default')->create();

        factory(User::class, 'shopkeeper', 10)->create();
        factory(User::class, 'producer', 10)->create();
    }
}
