<?php

namespace Tenderos\Http\ViewComposers\Protocols\Questions;

use Illuminate\Contracts\View\View;

class FormComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([

        ]);
    }
}
