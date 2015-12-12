<?php

use \Illuminate\Database\Seeder;
use Tenderos\Entities\User;

class ProducersTableSeeder extends Seeder
{
	private $producers = [
		['name' => 'lidia velasquez', 'doc' => null, 'tel' => 3103423011],
		['name' => 'serbo velasquez', 'doc' => null, 'tel' => 3112176881],
		['name' => 'ramon tarsisio rojas', 'doc' => null, 'tel' => 3115102525],
		['name' => 'victor manuel rojas clavijo', 'doc' => null, 'tel' => 3192576604],
		['name' => 'carlos f. arias m.', 'doc' => 13809008, 'tel' => 3115042644],
		['name' => 'juan diego arias r', 'doc' => null, 'tel' => 3115042644],
		['name' => 'martha lucia guzman', 'doc' => null, 'tel' => 3203181516],
		['name' => 'luz stella rivera', 'doc' => null, 'tel' => 3212316868],
		['name' => 'luis eduardo pissa', 'doc' => null, 'tel' => 3103866244],
		['name' => 'hilda ines vaca ruiz', 'doc' => 35502731, 'tel' => 3112494072],
		['name' => 'juliana castelblanco', 'doc' => null, 'tel' => 3153882845],
		['name' => 'belen monrroy', 'doc' => 51662815, 'tel' => 3134906691],
		['name' => 'liliana martinez', 'doc' => null, 'tel' => 3186448345],
		['name' => 'jessica m. bravo cortez', 'doc' => null, 'tel' => 3133636369],
		['name' => 'luis f. casas', 'doc' => 3292222, 'tel' => 3128153396],
		['name' => 'blanca  nelcy agudelo', 'doc' => 21234661, 'tel' => 3118892309],
		['name' => 'wilson bravo b.', 'doc' => null, 'tel' => 3108123000],
		['name' => 'marleny agudelo b.', 'doc' => null, 'tel' => null],
		['name' => 'rosa aura agudelo rincon', 'doc' => null, 'tel' => 3208003012],
		['name' => 'sonia rayo gil', 'doc' => null, 'tel' => 3144463769],
		['name' => 'edwar agudelo', 'doc' => null, 'tel' => 3208548770],
		['name' => 'gonzalo barrantes p', 'doc' => 3274673, 'tel' => 3112226037],
		['name' => 'dario romero', 'doc' => 1074129337, 'tel' => 3002086902],
		['name' => 'xiomara torres', 'doc' => 1110480933, 'tel' => 3224020145],
		['name' => 'armando  romero', 'doc' => 1074131463, 'tel' => 3224020145],
		['name' => 'ferney carrion', 'doc' => null, 'tel' => 3142296079],
		['name' => 'mercy carrion garzon', 'doc' => 40315463, 'tel' => 3102916639],
		['name' => 'ferney ahumeder', 'doc' => null, 'tel' => 3142518161],
		['name' => 'oscar j duran g', 'doc' => 7600649, 'tel' => 3164979814],
		['name' => 'edwin g rodriguez', 'doc' => null, 'tel' => null],
		['name' => 'carolina ramirez r', 'doc' => 65785231, 'tel' => 3156166655],
		['name' => 'oneida bermudez', 'doc' => 21189463, 'tel' => 3134924752],
		['name' => 'jose a. lopez', 'doc' => 3275954, 'tel' => 3115093374],
		['name' => 'leonardo rodriguez rios', 'doc' => null, 'tel' => 3124392732],
		['name' => 'liliana rodriguez', 'doc' => 40216689, 'tel' => 3114782282],
		['name' => 'norenzo garzon', 'doc' => null, 'tel' => 3138819770],
		['name' => 'mauricio rios', 'doc' => null, 'tel' => 3178609524],
		['name' => 'jose vicente prado', 'doc' => 86042429, 'tel' => 3143465979],
		['name' => 'jose ovidio gutierrez', 'doc' => 17325674, 'tel' => 3123923677],
		['name' => 'marino baquero', 'doc' => null, 'tel' => 3204942909],
		['name' => 'martha ived parrado', 'doc' => 40380998, 'tel' => 3134904171],
		['name' => 'elizabeth parrado', 'doc' => 40386576, 'tel' => 3123636914],
		['name' => 'luz melida gomez', 'doc' => 40367928, 'tel' => 3204509001],
		['name' => 'nelly gutierrez marinez', 'doc' => null, 'tel' => 3115388709]
	];

    public function run()
    {
    	$count = 5001;

		foreach ($this->producers as $producer) {
			
			User::create([
				'name'				=> $producer['name'],
				'doc'				=> $producer['doc'],
				'tel'				=> $producer['tel'],
				'username' 			=> $producer['tel'] ? $producer['tel']: $count,
				'password'			=> 123,
				'type'				=> 'producer',
				'municipality_id' 	=> 685,
				'email'				=> null		
			]);

			if(! $producer['tel'])
				$count ++;
		}
    }
}
