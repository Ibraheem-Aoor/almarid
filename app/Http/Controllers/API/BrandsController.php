<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use App\Models\ProductColor;
use App\Transformers\BrandTransformer;
use Illuminate\Http\Request;

class BrandsController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $brands = Brand::where('id',intval($request->get('id')))->get();
            if(count($brands->toArray())){
                $data = $this->sendData($brands,new BrandTransformer(),'brands',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $brands = Brand::where('status',1)->orderBy('sort','ASC');
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $brands = $brands->paginate(intval($request->get('limit')));
                }else{
                    $brands = $brands->paginate();
                }

                $data = $this->sendData($brands,new BrandTransformer(),'brands',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $brands = $brands->limit(intval($request->get('limit')));
                }
                $brands = $brands->get();
                $data = $this->sendData($brands,new BrandTransformer(),'brands',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
