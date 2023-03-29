<?php

namespace App\Http\Controllers\API;

use App\Models\Guide;
use App\Transformers\GuideTransformer;
use Illuminate\Http\Request;

class GuidesController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $guides = Guide::where('id',intval($request->get('id')))->get();
            if(count($guides->toArray())){
                $data = $this->sendData($guides,new GuideTransformer(),'guides',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $guides = Guide::orderBy('sort','ASC');
            if($request->has('lang') && in_array(strtolower($request->get('lang')),['ar','en'])){
                $guides = $guides->where('lang',strtoupper($request->get('lang')));
            }
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $guides = $guides->paginate(intval($request->get('limit')));
                }else{
                    $guides = $guides->paginate();
                }

                $data = $this->sendData($guides,new GuideTransformer(),'guides',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $guides = $guides->limit(intval($request->get('limit')));
                }
                $guides = $guides->get();
                $data = $this->sendData($guides,new GuideTransformer(),'guides',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
