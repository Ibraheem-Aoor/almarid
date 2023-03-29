<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Model;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\City;
use App\Models\OrgTypes;
use App\Models\Province;
use App\Http\Controllers\BackendController;

class HomeController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->data['cars'] = Product::count();
        $this->data['orders'] = Order::count();
        $this->data['brands'] = Brand::count();
        $this->data['models'] = Model::count();

//        $this->data['city'] = City::all();
//        $this->data['org_type'] = OrgTypes::all();
//        $this->data['province'] = Province::all();
//
//        $image = Ads::where('status',1)->where('file','!=','');
//        $video = Ads::where('status',1)->where('link','!=','');
//        $all_ads = Ads::where('status',1);
//        $inactive = Ads::where('status',0);
//
//        $this->filter = $request->all();
//        if( isset($this->filter['org_type_id']) && !empty($this->filter['org_type_id']) &&  intval($this->filter['org_type_id']) > 0 ){
//            $image = $image->where('org_type_id',intval($this->filter['org_type_id']));
//            $video = $video->where('org_type_id',intval($this->filter['org_type_id']));
//            $all_ads = $all_ads->where('org_type_id',intval($this->filter['org_type_id']));
//        }
//        if( isset($this->filter['type']) && !empty($this->filter['type'])  &&  intval($this->filter['type']) > 0 ){
//            $image = $image->where('type',intval($this->filter['type']));
//            $video = $video->where('type',intval($this->filter['type']));
//            $all_ads = $all_ads->where('type',intval($this->filter['type']));
//        }
//        if( isset($this->filter['province_id']) && !empty($this->filter['province_id'])  &&  intval($this->filter['province_id']) > 0 ){
//            $image = $image->where('province_id',intval($this->filter['province_id']));
//            $video = $video->where('province_id',intval($this->filter['province_id']));
//            $all_ads = $all_ads->where('province_id',intval($this->filter['province_id']));
//        }
//        if( isset($this->filter['city_id']) && !empty($this->filter['city_id'])  &&  intval($this->filter['city_id']) > 0 ){
//            $image = $image->where('city_id',intval($this->filter['city_id']));
//            $video = $video->where('city_id',intval($this->filter['city_id']));
//            $all_ads = $all_ads->where('city_id',intval($this->filter['city_id']));
//        }
//
//        $this->data['ads'] = $all_ads->count();
//        $this->data['videos'] = $video->count();
//        $this->data['images'] = $image->count();
//        $this->data['ads_error'] = (intval($this->data['ads'])-(intval($this->data['videos']) + intval($this->data['images'])));
//        $this->data['inactive'] = $inactive->count();
//

        return view('backend/common/home')
            ->with('data',$this->data);
    }
}
