<?php

namespace App\Http\Controllers\API;

use App\Models\Model;
use App\Transformers\ModelTransformer;
use Illuminate\Http\Request;

class ModelsController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $models = Model::where('id',intval($request->get('id')))->get();
            if(count($models->toArray())){
                $data = $this->sendData($models,new ModelTransformer(),'models',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $models = new Model;
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $models = $models->paginate(intval($request->get('limit')));
                }else{
                    $models = $models->paginate();
                }

                $data = $this->sendData($models,new ModelTransformer(),'models',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $models = $models->limit(intval($request->get('limit')));
                }
                $models = $models->get();
                $data = $this->sendData($models,new ModelTransformer(),'models',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
