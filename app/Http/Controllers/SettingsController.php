<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
class SettingsController extends Controller
{
	public function editPassword()
	{
		return view('settings.editPassword');
	}

	public function updatePassword(Request $request)
	{
		$user = Auth::user();
		$this->validate($request, [
			'password' => 'required|passcheck:' . $user->password,
			'new_password' => 'required|confirmed|min:6',
			], [
					'password.passcheck' => 'Password lama tidak sesuai'
				]);
		$user->password = $request->get('new_password');
		$user->save();
		Session::flash("flash_notification", [
			"level"=>"success",
			"message"=>"Password berhasil diubah"
		]);
		return redirect('settings/password');
	}
}
