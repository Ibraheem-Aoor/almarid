<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Transformers\ProductsTransformer;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;

use App\Transformers\AccessoryTransformer;
use App\Transformers\AccessoriesTransformer;

class ProductsController extends BaseController
{

	/**
	 * Create a new controller instance.
	 */
	public function __construct(){

	}

	public function index(Request $request){

		if($request->has('id') && intval($request->get('id')) > 0){
			$products = Product::with('category','brand','model','colors','images','options','options.optionCategory')->where('id',intval($request->get('id')))->where('type', 'CAR')->get();
			if(count($products->toArray())){
				$data = $this->sendData($products,new ProductTransformer(),'cars',false);
			} else{
				return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
			}
		}else{
			$products = Product::with('category','brand','model','colors','images','options','options.optionCategory')->where('status',1)->where('type', 'CAR')->orderBy('id','DESC');
			if($request->has('category_id') && intval($request->get('category_id')) > 0){
				$products = $products->where('category_id',intval($request->get('category_id')));
			}
			if($request->has('name') && !empty($request->get('name'))){
				$products = $products->where('name','like','%'.$request->get('name').'%');
			}
			if($request->has('model_id') && intval($request->get('model_id')) > 0){
				$products = $products->where('model_id',intval($request->get('model_id')));
			}
			if($request->has('brand_id') && intval($request->get('brand_id')) > 0){
				$products = $products->where('brand_id',intval($request->get('brand_id')));
			}
			if($request->has('is_new') && in_array(intval($request->get('is_new')),[0,1])){
				$products = $products->where('is_new',intval($request->get('is_new')));
			}
			if($request->has('is_offer') && in_array(intval($request->get('is_offer')),[0,1])){
				$products = $products->where('is_offer',intval($request->get('is_offer')));
			}
			if($request->has('min_price') && floatval($request->get('min_price')) > 0){
				$products = $products->where('price','>=',floatval($request->get('min_price')));
			}
			if($request->has('max_price') && floatval($request->get('max_price')) > 0){
				$products = $products->where('price','<=',floatval($request->get('max_price')));
			}
			if($request->has('option_id') && intval($request->get('option_id')) > 0){
				$products = $products->whereHas('options', function($q) use ($request){
					$q->where('option_id', intval($request->get('option_id')));
				});
			}
			
			if($request->has('pagination') && $request->get('pagination') == 1){
				if($request->has('limit') && intval($request->get('limit')) > 0){
					$products = $products->paginate(intval($request->get('limit')));
				}else{
					$products = $products->paginate();
				}

				if($request->has('with_relation') && intval($request->get('with_relation')) == 1){
					$data = $this->sendData($products,new ProductTransformer(),'cars',true);
				}else{
					$data = $this->sendData($products,new ProductsTransformer(),'cars',true);
				}

			}else{
				if($request->has('limit') && intval($request->get('limit')) > 0){
					$products = $products->limit(intval($request->get('limit')));
				}
				$products = $products->get();

				if($request->has('with_relation') && intval($request->get('with_relation')) == 1){
					$data = $this->sendData($products,new ProductTransformer(),'cars',false);
				}else{
					$data = $this->sendData($products,new ProductsTransformer(),'cars',false);
				}
			}
		}
		return $this->sendResponse(true,'success get Data',$data);
	}

	public function accessories(Request $request){

		if($request->has('id') && intval($request->get('id')) > 0) {
			$products = Product::with('colors', 'images')->where('id',intval($request->get('id')))->where('type', 'ACCESSORY')->get();
			if(count($products->toArray())){
				$data = $this->sendData($products,new AccessoryTransformer(),'accessories',false);
			} else{
				return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
			}
		} else {
			$products = Product::with('colors', 'images')->where('status',1)->where('type', 'ACCESSORY')->orderBy('id','DESC');
			if($request->has('category_id') && intval($request->get('category_id')) > 0){
				$products = $products->where('category_id',intval($request->get('category_id')));
			}
			if($request->has('name') && !empty($request->get('name'))){
				$products = $products->where('name','like','%'.$request->get('name').'%');
			}
			if($request->has('is_new') && in_array(intval($request->get('is_new')),[0,1])){
				$products = $products->where('is_new',intval($request->get('is_new')));
			}
			if($request->has('is_offer') && in_array(intval($request->get('is_offer')),[0,1])){
				$products = $products->where('is_offer',intval($request->get('is_offer')));
			}
			if($request->has('min_price') && floatval($request->get('min_price')) > 0){
				$products = $products->where('price','>=',floatval($request->get('min_price')));
			}
			if($request->has('max_price') && floatval($request->get('max_price')) > 0){
				$products = $products->where('price','<=',floatval($request->get('max_price')));
			}
			
			if($request->has('pagination') && $request->get('pagination') == 1){
				if($request->has('limit') && intval($request->get('limit')) > 0){
					$products = $products->paginate(intval($request->get('limit')));
				}else{
					$products = $products->paginate();
				}

				if($request->has('with_relation') && intval($request->get('with_relation')) == 1){
					$data = $this->sendData($products,new AccessoryTransformer(),'accessories',true);
				}else{
					$data = $this->sendData($products,new AccessoriesTransformer(),'accessories',true);
				}

			}else{
				if($request->has('limit') && intval($request->get('limit')) > 0){
					$products = $products->limit(intval($request->get('limit')));
				}
				$products = $products->get();

				if($request->has('with_relation') && intval($request->get('with_relation')) == 1){
					$data = $this->sendData($products,new AccessoryTransformer(),'accessories',false);
				}else{
					$data = $this->sendData($products,new AccessoriesTransformer(),'accessories',false);
				}
			}
		}
		return $this->sendResponse(true,'success get Data',$data);
	}
}
