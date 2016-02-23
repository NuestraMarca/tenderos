<?php

namespace Tenderos\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\User;
use Tenderos\Entities\Product;
use Auth;

class ShopkeeperComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
    	$producers  = User::with(['productions.product', 'municipality'])->producers()->orderBy('created_at')->take(60)->get();
        $products   = Auth::user()->shoppingInterestsLists();
        
        $view->with([
        	'producers'	=> $producers,
            'products'  => $products

        ]);
    }
}


