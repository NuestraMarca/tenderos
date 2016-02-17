<?php

namespace Tenderos\Http\ViewComposers\Users;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\Municipality;

class RegisterComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $municipalities = Municipality::allLists();
        $communes = [0 => 'No aplica',1,2,3,4,5,6,7,8];
        
        $view->with([
            'municipalities' => $municipalities,
            'communes'  => $communes
        ]);
    }
}
