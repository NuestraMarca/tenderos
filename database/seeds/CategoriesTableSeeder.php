<?php

use \Illuminate\Database\Seeder;
use Tenderos\Entities\Category;
use Tenderos\Entities\Product;

class CategoriesTableSeeder extends Seeder
{
	private $productsArray = [
		'tuberculos' 	=> ['papa', 'yuca', 'arracacha'],
		'verdura' 		=> ['cebolla cabezona roja', 'cebolla cabezona blanca', 'cebolla larga'],
		'platano' 		=> ['platano', 'hartón', 'topocho', 'banano'],
		'hortalizas' 	=> ['hortalizas', 'tomate', 'lechuga', 'calabaza', 'pepino'],
		'citricos' 		=> ['limón mandarino', 'mandarina', 'limón castilla', 'naranja'],
		'frutas' 		=> ['frutas', 'papaya', 'aguacate', 'mango', 'guayaba', 'mora', 'lulo']
	];

    public function run()
    {
    	foreach ($this->productsArray as $categoryName => $products) {
    		$category = Category::create(['name' => $categoryName]);
    		foreach ($products as $productName) {
    			$product = new Product(['name' => $productName]);
    			$category->products()->save($product);
    		}
    	}
    }
}
