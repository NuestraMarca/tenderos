<?php

namespace Tenderos\Http\ViewComposers\Companies;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\Company;

class ListComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $companies = Company::allTypePaginate();

        $view->with([
            'companies' => $companies,
        ]);
    }
}
