<?php

namespace App\Http\Controllers\WEB\EN;


use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\WEB\WebController;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Faq;
use App\Models\Guide;
use App\Models\Feature;
use App\Models\Methodology;
use App\Models\Country;
use App\Models\Evaluation;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Option;
use App\Models\Category;
use App\Models\Product;
use App\Models\ExportProduct;
use App\Models\Export;
use App\Models\Offer;
use App\Models\Order;
use App\Models\TrackingStatus;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class IndexController extends WebController
{


    public function index()
    {
        $features = Cache::rememberForever('features', function ()
        {
                return Feature::where('status',1)->get();
        });
    $methodologies = Cache::rememberForever('methodologies', function ()
                {
                        return Methodology::where('status',1)->get();
                });
    $evaluations = Cache::rememberForever('evaluations' , function()
                {
                    return Evaluation::where('status',1)->get();
                });
    $products = $this->products->take(4);
    $offers =  $this->offers->take(4);
    return view('WEB.EN.index')->with('addresses',$this->addresses)
                                   ->with('settings',$this->settings)
                                   ->with('features',$features)
                                   ->with('methodologies',$methodologies)
                                   ->with('evaluations',$evaluations)
                                   ->with('offers',$offers)
                                   ->with('products',$products)
                                   ->with('export_products',$this->export_products)
                                   ->with('categories',$this->categories)
                                   ->with('models',$this->models)
                                   ->with('brands',$this->brands)
                                   ->with('fuels',$this->fuels)
                                   ->with('min_price',$this->min_price)
                                   ->with('max_price',$this->max_price)
                                   ->with('current_min_price',300000)
                                   ->with('current_max_price',600000);
    }

    public function about()
    {
        return view('WEB.EN.about')->with('addresses',$this->addresses)
                                       ->with('settings',$this->settings)
                                       ->with('brands',$this->brands);
    }


    public function cars_search_advanced(Request $request)
    {

        $current_price = explode(";", request()->query('current_price',''));
        $category_id = request()->query('category_id',''); //input()
        $brand_id = request()->query('brand_id',''); //input()
        $model_id = request()->query('model_id',''); //input()
        $fuel_id = request()->query('fuel_id',''); //input()
        $current_min_price = $current_price[0]; //input()
        $current_max_price = $current_price[1]; //input()
        $name = request()->query('name',''); //input()

        $products = Product::query()->where('is_web',1)->where('status', 1)->where('type','CAR')
        ->where(function ($s) use ($name,$category_id,$brand_id,$model_id,$fuel_id,$current_min_price,$current_max_price) {
          $s->when($category_id,function($query,$category_id){
            return $query->where('category_id','=',$category_id);
        })
          ->when($brand_id,function($query,$brand_id){
              return $query->where('brand_id','=',$brand_id);
          })
          ->when($model_id,function($query,$model_id){
              return $query->where('model_id','=',$model_id);
          })
          ->when($current_max_price,function($query,$current_max_price){
              return $query->where('price','<=',$current_max_price);
          })
          ->when($current_min_price,function($query,$current_min_price){
              return $query->where('price','>=',$current_min_price);
          })
          ->when($name,function($query,$name){
              return $query->where('name','like', '%'.$name.'%');
          })
          ->when($fuel_id,function($query,$fuel_id){

            return  $query->whereHas('options', function ($query) use ($fuel_id){
                 $query->where('option_id','=',$fuel_id);
             });
             });
      })
      ->orderBy('id', 'desc')->get();

    //   Search for product in export products
      $export_products  =  ExportProduct::query()
      ->where(function ($s) use ($name,$category_id,$brand_id,$model_id,$fuel_id,$current_min_price,$current_max_price) {
        $s->when($model_id,function($query,$model_id){
            return $query->where('model','   ', '%'.Model::query()->find($model_id)->name.'%');
        })
        ->when($current_max_price,function($query,$current_max_price){
            return $query->where('price','<=',$current_max_price);
        })
        ->when($current_min_price,function($query,$current_min_price){
            return $query->where('price','>=',$current_min_price);
        })
        ->when($name,function($query,$name){
            return $query->where('name','like', '%'.$name.'%')
            ->orWhere('name_en','like','%'.$name.'%');
        })
        ->when($brand_id,function($query,$brand_id){
            return $query->where('name','like','%'.Brand::query()->find($brand_id)->name.'%')
                    ->orWhere('name_en','like','%'.Brand::query()->find($brand_id)->name.'%');
        });
    })
    ->orderBy('id', 'desc')
    ->where('is_web',1)->where('status', 1)
    ->get();


    return view('WEB.AR.cars')->with('products',$products)
                                ->with('export_products' , $export_products)
                                ->with('addresses',$this->addresses)
                                ->with('settings',$this->settings)
                                ->with('categories',$this->categories)
                                ->with('models',$this->models)
                                ->with('brands',$this->brands)
                                ->with('fuels',$this->fuels)
                                ->with('min_price',$this->min_price)
                                ->with('max_price',$this->max_price)
                                ->with('name',$name)
                                ->with('category_id',$category_id)
                                ->with('brand_id',$brand_id)
                                ->with('model_id',$model_id)
                                ->with('fuel_id',$fuel_id)
                                ->with('current_min_price',$current_min_price)
                                ->with('current_max_price',$current_max_price);
    }

    public function cars_search(Request $request)
    {

        $category_id = request()->query('category_id',''); //input()
        $brand_id = request()->query('brand_id',''); //input()
        $model_id = request()->query('model_id',''); //input()

        $products = Product::query()->where('is_web',1)->where('status', 1)->where('type','CAR')
        ->where(function ($s) use ($category_id,$brand_id,$model_id) {
          $s->when($category_id,function($query,$category_id){
            return $query->where('category_id','=',$category_id);
        })
          ->when($brand_id,function($query,$brand_id){
              return $query->where('brand_id','=',$brand_id);
          })
          ->when($model_id,function($query,$model_id){
              return $query->where('model_id','=',$model_id);
          });
      })
      ->orderBy('id', 'desc')->get();

      $export_products = ExportProduct::query()
      ->where(function ($s) use ($model_id , $brand_id) {
        $s->when($model_id,function($query,$model_id){
            return $query->where('model','like','%'.Model::query()->find($model_id)->name.'%');
        });
        $s->when($brand_id,function($query,$brand_id){
            return $query->where('name','like','%'.Brand::query()->find($brand_id)->name.'%')
                    ->orWhere('name_en','like','%'.Brand::query()->find($brand_id)->name.'%');
        });
    })->where('is_web',1)->where('status', 1)
    ->orderBy('id', 'desc')->get();


      return view('WEB.AR.cars')->with('products',$products)
                                ->with('addresses',$this->addresses)
                                ->with('export_products',$export_products)
                                ->with('settings',$this->settings)
                                ->with('categories',$this->categories)
                                ->with('models',$this->models)
                                ->with('brands',$this->brands)
                                ->with('fuels',$this->fuels)
                                ->with('min_price',$this->min_price)
                                ->with('max_price',$this->max_price)
                                ->with('category_id',$category_id)
                                ->with('brand_id',$brand_id)
                                ->with('model_id',$model_id)
                                ->with('fuel_id',null)
                                ->with('name',null)
                                ->with('current_min_price',300000)
                                ->with('current_max_price',600000);
    }
    public function offers_search_advanced(Request $request)
    {

        $current_price = explode(";", request()->query('current_price',''));
        $category_id = request()->query('category_id',''); //input()
        $brand_id = request()->query('brand_id',''); //input()
        $model_id = request()->query('model_id',''); //input()
        $fuel_id = request()->query('fuel_id',''); //input()
        $current_min_price = $current_price[0]; //input()
        $current_max_price = $current_price[1]; //input()
        $name = request()->query('name',''); //input()

        $products = Product::where('is_web',1)->where('is_offer',1)->where('status', 1)->where('type','CAR')
        ->where(function ($s) use ($name,$category_id,$brand_id,$model_id,$fuel_id,$current_min_price,$current_max_price) {
          $s->when($category_id,function($query,$category_id){
            return $query->where('category_id','=',$category_id);
        })
          ->when($brand_id,function($query,$brand_id){
              return $query->where('brand_id','=',$brand_id);
          })
          ->when($model_id,function($query,$model_id){
              return $query->where('model_id','=',$model_id);
          })
          ->when($current_max_price,function($query,$current_max_price){
              return $query->where('price','<=',$current_max_price);
          })
          ->when($current_min_price,function($query,$current_min_price){
              return $query->where('price','>=',$current_min_price);
          })
          ->when($name,function($query,$name){
              return $query->where('name','like', '%'.$name.'%');
          })
          ->when($fuel_id,function($query,$fuel_id){

            return  $query->whereHas('options', function ($query) use ($fuel_id){
                 $query->where('option_id','=',$fuel_id);
             });
             });
      })
      ->orderBy('id', 'desc')->get();

      return view('WEB.EN.offers')->with('products',$products)
                                ->with('addresses',$this->addresses)
                                ->with('settings',$this->settings)
                                ->with('categories',$this->categories)
                                ->with('models',$this->models)
                                ->with('brands',$this->brands)
                                ->with('fuels',$this->fuels)
                                ->with('min_price',$this->min_price)
                                ->with('max_price',$this->max_price)
                                ->with('name',$name)
                                ->with('category_id',$category_id)
                                ->with('brand_id',$brand_id)
                                ->with('model_id',$model_id)
                                ->with('fuel_id',$fuel_id)
                                ->with('current_min_price',$current_min_price)
                                ->with('current_max_price',$current_max_price);
    }

    public function offers_search(Request $request)
    {

        $category_id = request()->query('category_id',''); //input()
        $brand_id = request()->query('brand_id',''); //input()
        $model_id = request()->query('model_id',''); //input()

        $products = Product::where('is_web',1)->where('is_offer',1)->where('status', 1)->where('type','CAR')
        ->where(function ($s) use ($category_id,$brand_id,$model_id) {
          $s->when($category_id,function($query,$category_id){
            return $query->where('category_id','=',$category_id);
        })
          ->when($brand_id,function($query,$brand_id){
              return $query->where('brand_id','=',$brand_id);
          })
          ->when($model_id,function($query,$model_id){
              return $query->where('model_id','=',$model_id);
          });
      })
      ->orderBy('id', 'desc')->get();

      return view('WEB.EN.offers')->with('products',$products)
                                ->with('addresses',$this->addresses)
                                ->with('settings',$this->settings)
                                ->with('categories',$this->categories)
                                ->with('models',$this->models)
                                ->with('brands',$this->brands)
                                ->with('fuels',$this->fuels)
                                ->with('min_price',$this->min_price)
                                ->with('max_price',$this->max_price)
                                ->with('category_id',$category_id)
                                ->with('brand_id',$brand_id)
                                ->with('model_id',$model_id)
                                ->with('fuel_id',null)
                                ->with('name',null)
                                ->with('current_min_price',300000)
                                ->with('current_max_price',600000);
    }

    public function contact()
    {
        return view('WEB.EN.contact')->with('addresses',$this->addresses)
                                     ->with('settings',$this->settings);
    }


    public function add_contact(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'phonenumber'=>'required|string|max:255',
            'message'=>'required|string',
        ]);

        $contact = Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phonenumber'=>$request->phonenumber,
            'message'=>$request->message,
        ]);

        session()->flash('success', 'شكرا لتواصلك معنا، سيتم التواصل معك قريبا');
        return redirect()->back();
    }

    public function add_export(Request $request)
    {

        $this->validate($request,[
            'export_product_id'=>'nullable|numeric',
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'phonenumber'=>'required|string|max:255',
            'message'=>'required|string',
        ]);
        $contact = Export::create([
            'export_product_id'=>$request->export_product_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'phonenumber'=>$request->phonenumber,
            'message'=>$request->message,
        ]);

        session()->flash('success', 'شكرا لتواصلك معنا، سيتم التواصل معك قريبا');
        return redirect()->back();
    }


    public function offers()
    {
        $products = Product::where('is_web',1)->where('is_offer',1)->where('status',1)->where('type','CAR')->orderBy('id', 'desc')->get();
        return view('WEB.EN.offers')->with('addresses',$this->addresses)
                                  ->with('settings',$this->settings)
                                  ->with('products',$products)
                                  ->with('categories',$this->categories)
                                  ->with('models',$this->models)
                                  ->with('brands',$this->brands)
                                  ->with('fuels',$this->fuels)
                                  ->with('min_price',$this->min_price)
                                  ->with('max_price',$this->max_price)
                                  ->with('category_id',null)
                                  ->with('brand_id',null)
                                  ->with('model_id',null)
                                  ->with('fuel_id',null)
                                  ->with('name',null)
                                  ->with('current_min_price',300000)
                                  ->with('current_max_price',600000);
    }
    public function cars()
    {
        $products = $this->products;
        return view('WEB.EN.cars')->with('addresses',$this->addresses)
                                  ->with('settings',$this->settings)
                                  ->with('products',$products)
                                  ->with('export_products',$this->export_products)
                                  ->with('categories',$this->categories)
                                  ->with('models',$this->models)
                                  ->with('brands',$this->brands)
                                  ->with('fuels',$this->fuels)
                                  ->with('min_price',$this->min_price)
                                  ->with('max_price',$this->max_price)
                                  ->with('category_id',null)
                                  ->with('brand_id',null)
                                  ->with('model_id',null)
                                  ->with('fuel_id',null)
                                  ->with('name',null)
                                  ->with('current_min_price',300000)
                                  ->with('current_max_price',600000);
    }

    public function export()
    {
        return view('WEB.EN.export')->with('addresses',$this->addresses)
                                    ->with('settings',$this->settings)
                                    ->with('products',$this->export_products);
    }

    public function questions()
    {
        $questions= Faq::where('status',1)->where('lang','EN')->get();
        return view('WEB.EN.questions')->with('addresses',$this->addresses)
                                       ->with('settings',$this->settings)
                                       ->with('questions',$questions);
    }

    public function kmaliat()
    {
        return view('WEB.EN.kmaliat')->with('addresses',$this->addresses)
                                     ->with('settings',$this->settings);
    }

    public function learn()
    {
        $learns= Guide::where('status',1)->where('lang','EN')->get();
        return view('WEB.EN.learn')->with('addresses',$this->addresses)
                                   ->with('settings',$this->settings)
                                   ->with('learns',$learns);
    }

    public function privacy()
    {
        $privacy=Page::find(2);
        return view('WEB.EN.privacy')->with('addresses',$this->addresses)
                                     ->with('settings',$this->settings)
                                     ->with('privacy',$privacy);
    }

    public function condition()
    {
        $condition=Page::find(4);
        return view('WEB.EN.condition')->with('addresses',$this->addresses)
                                       ->with('settings',$this->settings)
                                       ->with('condition',$condition);
    }

    public function car($id)
    {
        $product = Product::where('is_web',1)->where('status',1)
        ->where('type','CAR')->where('id',$id)->first();

        if(is_null($product)){
            session()->flash('error', 'Car not found');
            return redirect()->back();
        }

        return view('WEB.EN.single_car')->with('addresses',$this->addresses)
                                        ->with('settings',$this->settings)
                                        ->with('product',$product);
    }

    public function export_car($id)
    {
        $product = ExportProduct::where('is_web',1)->where('status',1)->where('id',$id)->first();

        if(is_null($product)){
            session()->flash('error', 'Car not found');
            return redirect()->back();
        }
        return view('WEB.EN.single_export_car')->with('addresses',$this->addresses)->with('settings',$this->settings)
                                        ->with('product',$product);
    }

    public function evaluations()
    {
        $countries =Country::all();
        $evaluations = Evaluation::where('status',1)->get();
        return view('WEB.EN.evaluations')->with('addresses',$this->addresses)
                                         ->with('settings',$this->settings)
                                         ->with('countries',$countries)
                                         ->with('evaluations',$evaluations);
    }

    public function  add_evaluation(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'phonenumber'=>'required|string|max:255',
            'message'=>'required|string',
            'image' => 'nullable|mimes:jpg,png,gif,jpeg,mp4,ogx,oga,ogv,ogg,webm',
        ]);
        $image_path =NULL;
        if($request->hasFile('image')){
            $image_path = $this->uploadImage($request, 'image', 'evaluations');
        }

        $evaluation = Evaluation::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'country_id'=>$request->country_id,
            'phonenumber'=>$request->phonenumber,
            'message'=>$request->message,
            'file'=>$image_path,
        ]);

        session()->flash('success', 'شكرا لك');
        return redirect()->back();
    }

    public function uploadImage(Request $request,$image_name = 'image',$folder_name = 'images'){
        if($request->hasFile($image_name)){
            $file = $request->file($image_name);
            list($this->width, $this->height) = getimagesize($file);
            $this->originalName = $file->getClientOriginalName();
            $this->size = $file->getSize();
            $extension = $file->getClientOriginalExtension();
            $onlyName = explode('.'.$extension,$this->originalName);
            $fid = time();
            $file->move('uploads/'.$folder_name, $fid.'.'.$extension);
            $imgpath = $fid.'.'.$extension;

            return $imgpath;
        }else{
            return NULL;
        }
    }

       public function tracking(Request $request)
    {
        $this->validate($request,[
            'tracking_number'=>'required|string|max:255',
            'email'=>'required|email',
        ]);
        if($request->has('tracking_number') && $request->has('email') && filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){
			$order = Order::where('email', $request->get('email'))->where('tracking_number', $request->get('tracking_number'))->first();

			if($order){
                    return redirect()->route('en.status',['id',$order->status]);

			}
		}

            session()->flash('error', 'Invalid Data ');
            return redirect()->back();



    }
    public function status($id)
    {
        $status=TrackingStatus::find($id);
        if(is_null($status)){
              session()->flash('error', 'page not found');
            return redirect()->back();
        }

                    return view('WEB.EN.status')->with('addresses',$this->addresses)
                    ->with('settings',$this->settings)
                    ->with('status',$status);




    }

    public function tracking_view()
    {
                    return view('WEB.EN.tracking')->with('addresses',$this->addresses)
                    ->with('settings',$this->settings);

    }

    public function order_view($id)
    {
        $product =Product::find($id);
        if(!$product->count() || ($product->count() && ($product['quantity']) < 1)) {
            session()->flash('error', 'Out of stuck <br/> نفذت الكمية!');
          return redirect()->back();
        }
                    return view('WEB.EN.user1')->with('product',$product)->with('addresses',$this->addresses)
                    ->with('settings',$this->settings);

    }

        public function new_order(Request $request){

            $product = Product::where('id', intval($request['product_id']));
            /*
            if(!$product->count() || ($product->count() && ($product->first()['quantity']) < 1)) {
                session()->flash('error', 'Out of stuck <br/> نفذت الكمية!');
              return redirect()->back();
            }*/
            if($request->has('name') && $request->has('last_name') && $request->has('email') && filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) && $request->has('mobile') && $request->has('product_id')){
                $name = $request->get('name');
                $last_name = $request->get('last_name');
                $email = $request->get('email');
                $mobile = $request->get('mobile');
                $product_id = $request->get('product_id');
                $color_id = $request->get('color_id');
                $address = $request->get('address');
                $long = '';
                $lat = '';

                $product = Product::find(intval($product_id));

                if($product){

                    $order = Order::create([
                        'name' => $name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'mobile' => $mobile,
                        'product_id' => intval($product_id),
                        'color_id' => intval($color_id),
                        'address' => $address,
                        'long' => $long,
                        'lat' => $lat,
                        'deposit' => $product->deposit,
                        'price' => $product->price,
                        'offer_price' => $product->offer_price,
                        'deleted_at' => Carbon::now(),
                    ]);
                    $tracking_number = $order->id.$product_id.substr(str_shuffle("0123456789"), 0, 3);
                    $order->update([
                        'tracking_number' => $tracking_number
                    ]);


                  //  Product::where('id',intval($product_id))->update(['quantity' => (intval($product->quantity) - 1 ) ]);
                }else{
                    session()->flash('error', 'Enter Valid Product');
                  return redirect()->back();
                }

                return view('WEB.EN.user2')->with('order',$order)->with('addresses',$this->addresses)
                ->with('settings',$this->settings);
            } else{

                session()->flash('error', 'Enter Valid data <br/> أدخل البيانات المطلوبة بشكل صحيح');
              return redirect()->back();
            }
        }
        public function paid_view(Request $request){
           session()->flash('success',"Done successfully. A Tracking Code Has Been Send To Your Email");
            return redirect("/");
          #  return view('WEB.EN.user3')->with('order_id',$request['order_id'])->with('addresses',$this->addresses)
           # ->with('settings',$this->settings);
        }

        public function paid(Request $request){
            return view('WEB.EN.user3')->with('order_id',$request['order_id'])->with('addresses',$this->addresses)
            ->with('settings',$this->settings);
        }

}
