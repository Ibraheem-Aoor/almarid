<?php

namespace App\Http\Controllers\API;

use App\Models\Page;
use App\Models\Setting;
use App\Transformers\PageTransformer;
use App\Transformers\SettingTransformer;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }

    public function index(Request $request){

        $setting = new Setting;
        if($request->has('key') && !empty($request->get('key'))){
            $setting = $setting->where('key',$request->get('key'));
        }
        $setting = $setting->get();
        $data = $this->sendData($setting,new SettingTransformer(),'settings',false);
    
        return $this->sendResponse(true,'success get all settings',$data);
    }



    public function pages(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $brands = Page::where('id',intval($request->get('id')))->get();
            if(count($brands->toArray())){
                $data = $this->sendData($brands,new PageTransformer(),'pages',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $brands = Page::where('status',1);
            if($request->has('lang') && in_array(strtolower($request->get('lang')),['ar','en'])){
                $brands = $brands->where('lang',strtoupper($request->get('lang')));
            }
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $brands = $brands->paginate(intval($request->get('limit')));
                }else{
                    $brands = $brands->paginate();
                }

                $data = $this->sendData($brands,new PageTransformer(),'pages',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $brands = $brands->limit(intval($request->get('limit')));
                }
                $brands = $brands->get();
                $data = $this->sendData($brands,new PageTransformer(),'pages',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }

}
