<?php

use \Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('DeparmentsTableSeeder'); // Static
        $this->call('MunicipalitiesTableSeeder'); // Static
        $this->call('CategoriesTableSeeder'); // Static
        $this->call('UsersTableSeeder'); // Static

        if(env('APP_ENV') != 'production') {
            $this->call('ProducersTableSeeder'); // Static
            $this->call('ShopkeepersTableSeeder'); // Static
        }
    }
}

/*
* 
*/
