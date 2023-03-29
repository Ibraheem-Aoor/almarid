<?php

namespace App\Http\Controllers\API;

use App\Models\Language;
use App\Transformers\LanguageTransformer;
use Illuminate\Http\Request;

class LanguagesController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $languages = Language::where('id',intval($request->get('id')))->get();
            if(count($languages->toArray())){
                $data = $this->sendData($languages,new LanguageTransformer(),'languages',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $languages = new Language;
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $languages = $languages->paginate(intval($request->get('limit')));
                }else{
                    $languages = $languages->paginate();
                }

                $data = $this->sendData($languages,new LanguageTransformer(),'languages',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $languages = $languages->limit(intval($request->get('limit')));
                }
                $languages = $languages->get();
                $data = $this->sendData($languages,new LanguageTransformer(),'languages',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
