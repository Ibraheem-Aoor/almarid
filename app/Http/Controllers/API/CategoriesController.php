<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $categories = Category::where('id',intval($request->get('id')))->get();
            if(count($categories->toArray())){
                $data = $this->sendData($categories,new CategoryTransformer(),'categories',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $categories = Category::where('status',1)->orderBy('sort','ASC');
            if($request->has('type') && in_array(strtolower($request->get('type')),['car','faq','options'])){
                $categories = $categories->where('type',strtoupper($request->get('type')));
            }
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $categories = $categories->paginate(intval($request->get('limit')));
                }else{
                    $categories = $categories->paginate();
                }

                $data = $this->sendData($categories,new CategoryTransformer(),'categories',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $categories = $categories->limit(intval($request->get('limit')));
                }
                $categories = $categories->get();
                $data = $this->sendData($categories,new CategoryTransformer(),'categories',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
