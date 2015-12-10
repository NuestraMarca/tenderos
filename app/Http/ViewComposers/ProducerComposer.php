<?php

namespace Tenderos\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\User;
use Tenderos\Entities\Product;
use Tenderos\Entities\Municipality;
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
        $shopkeepers        = User::with(['shoppingInterests', 'municipality'])->shopkeepers()->orderBy('created_at')->take(12)->get();
        $municipalities     = Municipality::allLists();

        $view->with([
        	'municipalities'	=> $municipalities,
            'products'          => $products,
            'shopkeepers'       => $shopkeepers
        ]);
    }
}


