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
        
        $view->with([
            'municipalities' => $municipalities,
        ]);
    }
}
