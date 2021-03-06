<?php

namespace Tenderos\Http\ViewComposers\Formats;

use Illuminate\Contracts\View\View;
use Auth;

class ListComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $formats = Auth::user()->company->formats()->orderBy('updated_at', 'desc')->paginate(20);

        $view->with([
            'formats' => $formats,
        ]);
    }
}
