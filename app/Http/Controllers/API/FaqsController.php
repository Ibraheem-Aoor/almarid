<?php

namespace App\Http\Controllers\API;

use App\Models\Faq;
use App\Transformers\FaqTransformer;
use Illuminate\Http\Request;

class FaqsController extends BaseController
{

    /**
     * Create a new controller instance.
     */
    public function __construct(){

    }
    function br2nl($string) {
	    
	    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
	} 
    public function index(Request $request){

        if($request->has('id') && intval($request->get('id')) > 0){
            $faqs = Faq::with('category')->where('id',intval($request->get('id')))->get();
            foreach ($faqs as $faq) {
                $faq->answer = br2nl($faq['answer']);
            }
            if(count($faqs->toArray())){
                $data = $this->sendData($faqs,new FaqTransformer(),'faqs',false);
            } else{
                return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
            }
        }else{
            $faqs = Faq::with('category')->where('status',1)->orderBy('sort','ASC');
            if($request->has('category_id') && intval($request->get('category_id')) > 0){
                $faqs = $faqs->where('category_id',intval($request->get('category_id')));
            }
            if($request->has('lang') && in_array(strtolower($request->get('lang')),['ar','en'])){
                $faqs = $faqs->where('lang',strtoupper($request->get('lang')));
            }
            if($request->has('pagination') && $request->get('pagination') == 1){
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $faqs = $faqs->paginate(intval($request->get('limit')));
                }else{
                    $faqs = $faqs->paginate();
                }

                $data = $this->sendData($faqs,new FaqTransformer(),'faqs',true);
            }else{
                if($request->has('limit') && intval($request->get('limit')) > 0){
                    $faqs = $faqs->limit(intval($request->get('limit')));
                }
                $faqs = $faqs->get();
                $data = $this->sendData($faqs,new FaqTransformer(),'faqs',false);
            }
        }
        return $this->sendResponse(true,'success get Data',$data);
    }
}
