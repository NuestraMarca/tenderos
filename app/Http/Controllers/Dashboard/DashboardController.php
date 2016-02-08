<?php

namespace Tenderos\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Tenderos\Http\Requests;
use Tenderos\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Tenderos\Entities\Message;
use Auth;

class DashboardController extends Controller
{
	var $pusher;
    var $user;
    var $chatChannel;

    const DEFAULT_CHAT_CHANNEL = 'chat_';

    public function __construct()
    {
        $this->pusher       = App::make('pusher');
        $this->user         = Auth::user();
        $this->chatChannel  = self::DEFAULT_CHAT_CHANNEL;
    }

    public function index()
    {
        return view('home');
    }

    public function docs()
    {
        return view('documentacion');
    }

    public function admin()
    {
    	if(Auth::user()->isShopkeeper()) {
    		return view('dashboard.pages.shopkeeper', ['chatChannel' => $this->chatChannel . $this->user->id]);	
    	}
    	else if(Auth::user()->isProducer()) {
    		return view('dashboard.pages.producer', ['chatChannel' => $this->chatChannel . $this->user->id]);
    	}

        return redirect()->route('admin.categories.index');
    }

    public function postMessage(Request $request)
    {
        $message = Message::create([
            'text'         => e($request->input('text')),
            'author_id'    => $this->user->id,
            'receptor_id'  => e($request->input('receptor_id')),
        ])->load('author', 'receptor');

        $this->pusher->trigger($this->chatChannel . $message->receptor_id, 'new-message', $message);
    }

}
