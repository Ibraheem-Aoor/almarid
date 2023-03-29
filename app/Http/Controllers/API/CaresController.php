<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CaresController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        if($request->has('pagination') && $request->get('pagination') == 1){
            $category = Category::paginate();
            $data = $this->sendData($category,new CategoryTransformer(),'categories',true);
        }else{
            $category = Category::all();
            $data = $this->sendData($category,new CategoryTransformer(),'categories',false);
        }

//        return $data;
        return $this->sendResponse(true,'success get all Categories',$data);
    }

}
