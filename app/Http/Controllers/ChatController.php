<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\A;
use App\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
	public function chat()
	{
		return view('chat');
	}

	public function send(Request $request)
	{
		$request->all();
		// $user = "Angel";
		// $user = User::find(Auth::id());

		// event(new ChatEvent($request->$message, $user));
	}


	public function send2()
	{
		$message = 'Hello';
		$user = "Angel";

		// event(new ChatEvent($message, $user));
		event(new A());
	}
}
