<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LanguageController extends Controller {

    public function index(Request $request){
        $lang = $request->get('lang');
        session(['lang'=>$lang]);
        return redirect()->back();
    }


}
