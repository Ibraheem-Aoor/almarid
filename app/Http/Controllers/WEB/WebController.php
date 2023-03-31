<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Setting;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Option;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{


    public $addresses ,
            $settings,
            $brands,
            $fuels,
            $categories,
            $models,
            $min_price,
            $max_price;

    public function __construct(){
        $this->setControllerData();
    }

    public function setControllerData()
    {
        $this->addresses = Cache::rememberForEver('addresses' , function()
                            {
                                return Address::where('status',1)->get();
                            });
        $this->settings = Cache::rememberForEver('settings' , function()
                            {
                                return Setting::all();
                            });
        $this->brands = Cache::rememberForever('brands' , function()
                        {
                            return Brand::where('status',1)->get();
                        });
        $this->models = Cache::rememberForever('models' , function()
                        {
                            return Model::orderBy('name', 'asc')->get();
                        });
        $this->fuels = Cache::rememberForever('fuels' , function()
                        {
                            return Option::where('category_id',22)->get();
                        });

        $this->categories = Cache::rememberForever('categories' , function()
        {
            return Category::where('status',1)->where('type','CAR')->get();;
        });
        $this->min_price = Cache::rememberForever('min_price' , function()
        {
                return Setting::where('key','min_price')->first()->value;
        });
        $this->max_price = Cache::rememberForever('max_price' , function()
        {
                return Setting::where('key','max_price')->first()->value;
        });
    }
}
