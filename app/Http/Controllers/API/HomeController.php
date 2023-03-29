<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Model;
use App\Models\Product;
use App\Models\User;
use App\Models\Slider;
use App\Transformers\BrandTransformer;
use App\Transformers\CategoryTransformer;
use App\Transformers\ModelTransformer;
use App\Transformers\ProductsTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\SliderTransformer;
use App\Transformers\AccessoriesTransformer;

class HomeController extends BaseController
{

	/**
	 * Create a new controller instance.
	 */
	public function __construct(){

	}

	public function index(){
		$category = Category::where('type','CAR')->get();
		$categoryData = $this->sendData($category,new CategoryTransformer(),'categories',false);
		
		$accessoriesCategory = Category::where('type','ACCESSORY')->get();
		$accessoriesCategoryData = $this->sendData($accessoriesCategory,new CategoryTransformer(),'accessoriesCategory',false);

		$model = Model::all();
		$modelData = $this->sendData($model,new ModelTransformer(),'models',false);

		$brands = Brand::all();
		$brandsData = $this->sendData($brands,new BrandTransformer(),'brands',false);

		$offers = Product::with('category','brand','model','colors','images','options')
			->where('status',1)
			->where('is_offer',1)
//            ->where('is_new',0)
			->limit(10)
			->orderBy('id','DESC')
			->get();
		$offerData = $this->sendData($offers,new ProductsTransformer(),'offers',false);

		$latest = Product::with('category','brand','model','colors','images','options')
			->where('type','CAR')
			->where('status',1)
			->where('is_new',1)
			->where('is_offer',0)
			->limit(10)
			->orderBy('id','DESC')
			->get();
		$latestData = $this->sendData($latest,new ProductsTransformer(),'latest',false);

		$accessoriesOffers = Product::with('category','brand','model','colors','images','options')
									->where('status',1)
									->where('is_offer',1)
									->where('type', 'ACCESSORY')
									->limit(10)
									->orderBy('id','DESC')
									->get();
		$accessoriesOfferData = $this->sendData($accessoriesOffers,new AccessoriesTransformer(),'accessoriesOffers',false);

		$latestAccessories = Product::with('category','brand','model','colors','images','options')
									->where('status',1)
									->where('is_new',1)
									->where('is_offer',0)
									->where('type', 'ACCESSORY')
									->limit(10)
									->orderBy('id','DESC')
									->get();
		$latestAccessoriesData = $this->sendData($latestAccessories,new AccessoriesTransformer(),'latestAccessories',false);

		$accessoriesSliders = Slider::where('status',1)->orderBy('sort','ASC')->where('type', 'ACCESSORY')->get();
		$accessoriesSlidersData = $this->sendData($accessoriesSliders,new SliderTransformer(),'sliders',false);

		return $this->sendResponse(true,'success get datat',$this->margeData([
			$offerData,
			$latestData,
			$categoryData,
			$accessoriesCategoryData,
			$modelData,
			$brandsData,
			$accessoriesOfferData,
			$latestAccessoriesData,
			$accessoriesSlidersData
		]));
	}


}