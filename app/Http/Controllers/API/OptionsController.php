<?php

namespace App\Http\Controllers\API;

use App\Models\Option;
use App\Transformers\OptionTransformer;
use Illuminate\Http\Request;

class OptionsController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $options = Option::with('category')->where('id',intval($request->get('id')))->get();
            if(count($options->toArray())){
                $data = $this->sendData($options,new OptionTransformer(),'options',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $options = Option::with('category');
            if($request->has('category_id') && intval($request->get('category_id')) > 0){
                $options = $options->where('category_id',intval($request->get('category_id')));
            }
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $options = $options->paginate(intval($request->get('limit')));
                }else{
                    $options = $options->paginate();
                }

                $data = $this->sendData($options,new OptionTransformer(),'options',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $options = $options->limit(intval($request->get('limit')));
                }
                $options = $options->get();
                $data = $this->sendData($options,new OptionTransformer(),'options',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
