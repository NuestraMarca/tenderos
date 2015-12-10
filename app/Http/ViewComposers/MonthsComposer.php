<?php

namespace Tenderos\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\Production;

class MonthsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $months = Production::$months;

        $view->with([
        	'months'	=> $months
        ]);
    }
}