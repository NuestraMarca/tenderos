<?php

use \Illuminate\Database\Seeder;
use Tenderos\Entities\Deparment;

class DeparmentsTableSeeder extends Seeder
{
	private $deparmentsArray = [
		['id' => 5,	'name' => 'antioquia'],
		['id' => 8,	'name' => 'atlantico'],
		['id' => 11, 'name' => 'bogota'],
		['id' => 13, 'name' => 'bolivar'],
		['id' => 15, 'name' => 'boyaca'],
		['id' => 17, 'name' => 'caldas'],
		['id' => 18, 'name' => 'caqueta'],
		['id' => 19, 'name' => 'cauca'],
		['id' => 20, 'name' => 'cesar'],
		['id' => 23, 'name' => 'cordoba'],
		['id' => 25, 'name' => 'cundinamarca'],
		['id' => 27, 'name' => 'choco'],
		['id' => 41, 'name' => 'huila'],
		['id' => 44, 'name' => 'la guajira'],
		['id' => 47, 'name' => 'magdalena'],
		['id' => 50, 'name' => 'meta'],
		['id' => 52, 'name' => 'nariño'],
		['id' => 54, 'name' => 'norte de santander'],
		['id' => 63, 'name' => 'quindio'],
		['id' => 66, 'name' => 'risaralda'],
		['id' => 68, 'name' => 'santander'],
		['id' => 70, 'name' => 'sucre'],
		['id' => 73, 'name' => 'tolima'],
		['id' => 76, 'name' => 'valle del cauca'],
		['id' => 81, 'name' => 'arauca'],
		['id' => 85, 'name' => 'casanare'],
		['id' => 86, 'name' => 'putumayo'],
		['id' => 88, 'name' => 'san andres'],
		['id' => 91, 'name' => 'amazonas'],
		['id' => 94, 'name' => 'guainia'],
		['id' => 95, 'name' => 'guaviare'],
		['id' => 97, 'name' => 'vaupes'],
		['id' => 99, 'name' => 'vichada']
	];

    public function run()
    {
    	foreach ($this->deparmentsArray as $deparment) {
    		Deparment::create($deparment);
    	}
    }
}
