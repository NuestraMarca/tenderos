<?php

namespace Tenderos\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Tenderos\Entities\User;
use Tenderos\Entities\Session;
use Auth;

class HomeComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        Session::updateCurrent();
        $sessions       = Session::registered()->withUserMessages()->where('user_id', '<>', Auth::user()->id)->get();  
        $offlineUsers   = User::getOfflineWithMessages();
        
        $user  = Auth::user();

        $view->with([
        	'sessions'	    => $sessions,
            'user'		    => $user,
            'offlineUsers'  => $offlineUsers
        ]);
    }
}


