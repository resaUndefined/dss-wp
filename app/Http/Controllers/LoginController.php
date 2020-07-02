<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$tmpUser = User::where([
    				'username' => $request->username
    		])->first();

    	if (!is_null($tmpUser)) {
    		if (Auth::attempt([
    		'username' => $request->username,
    		'password' => $request->password
    		])) {
	    		$user = User::where([
	    					'username' => $request->username
	    				])->first();
	    		return redirect()->route('home');
            }
	    	return redirect()->back()->with('message', 'Maaf Kombinasi username dan password tidak sesuai');
    	}
	    return redirect()->back()->with('message', 'Maaf kami tidak dapat menemukan akun anda!');
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}