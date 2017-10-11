<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validate;
use Auth;

class SettingsController extends Controller
{
    public function editPassword() {
    	return view('settings.editPassword');
    }

    public function updatePassword() {
    	$user = Auth::user();
    	$this->validate($request, [
    		'password' => 'required|passcheck:'. $user->password
    	]); 
    }
}
