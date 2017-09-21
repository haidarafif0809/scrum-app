<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class TemaController extends Controller
{
    public function AturTema($tema) {
    	setcookie('tema', $tema, time() + (86400 * 30), "/");
    	return back();
    }
}
