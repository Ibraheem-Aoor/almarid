<?php

namespace App\Http\Controllers\API;

use App\Models\Slider;
use App\Transformers\SliderTransformer;
use Illuminate\Http\Request;

class SlidersController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $sliders = Slider::where('id',intval($request->get('id')))->get();
            if(count($sliders->toArray())){
                $data = $this->sendData($sliders,new SliderTransformer(),'sliders',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $sliders = Slider::where('status',1)->orderBy('sort','ASC');
            if($request->has('lang') && in_array(strtolower($request->get('lang')),['ar','en'])){
                $sliders = $sliders->where('lang',strtoupper($request->get('lang')));
            }
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $sliders = $sliders->paginate(intval($request->get('limit')));
                }else{
                    $sliders = $sliders->paginate();
                }

                $data = $this->sendData($sliders,new SliderTransformer(),'sliders',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $sliders = $sliders->limit(intval($request->get('limit')));
                }
                $sliders = $sliders->get();
                $data = $this->sendData($sliders,new SliderTransformer(),'sliders',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
