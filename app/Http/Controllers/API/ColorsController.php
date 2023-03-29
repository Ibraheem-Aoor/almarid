<?php

namespace App\Http\Controllers\API;

use App\Models\Color;
use App\Transformers\ColorTransformer;
use Illuminate\Http\Request;

class ColorsController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $colors = Color::where('id',intval($request->get('id')))->get();
            if(count($colors->toArray())){
                $data = $this->sendData($colors,new ColorTransformer(),'colors',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $colors = new Color;
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $colors = $colors->paginate(intval($request->get('limit')));
                }else{
                    $colors = $colors->paginate();
                }

                $data = $this->sendData($colors,new ColorTransformer(),'colors',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $colors = $colors->limit(intval($request->get('limit')));
                }
                $colors = $colors->get();
                $data = $this->sendData($colors,new ColorTransformer(),'colors',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
