<?php

namespace Tenderos\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\User;
use Tenderos\Entities\Product;
use Auth;

class ProducerComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $products           = Product::allLists();
        $shopkeepers        = User::searchShopkeepers();
        $communes           = ['1' => 'Comuna 1', '2' => 'Comuna 2', '3' => 'Comuna 3', '4' => 'Comuna 4', 
                                '5' => 'Comuna 5', '6' => 'Comuna 6', '7' => 'Comuna 7', '8' => 'Comuna 8'];

        $view->with([
        	'communes'	=> $communes,
            'products'          => $products,
            'shopkeepers'       => $shopkeepers
        ]);
    }
}


