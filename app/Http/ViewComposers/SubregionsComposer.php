<?php

namespace Tenderos\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class SubregionsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $subregions = [
            'rio_meta'              => 'Rio Meta', 
            'la_macarena'           => 'La Macarena', 
            'area_metropolitana'    => 'Area Metropolitana', 
            'meta_sur'              => 'Meta Sur', 
            'piedemonte'            => 'Piedemonte', 
            'ariari'                => 'Ariari', 
            'otra_region'           => 'Otra Region'
        ];

        $view->with([
        	'subregions'	=> $subregions
        ]);
    }
}