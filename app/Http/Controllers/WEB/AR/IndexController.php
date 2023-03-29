<?php

namespace App\Http\Controllers\WEB\AR;


use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Basel\Paytabs\Paytabs;
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
use Illuminate\Support\Facades\Mail;


use Carbon\Carbon;
class IndexController extends Controller
{


    private $addresses = null;
    private $settings = null;

    public function __construct(){
        $this->addresses = Address::where('status',1)->get();
        $this->settings = Setting::all();
        $this->brands = Brand::where('status',1)->get();
        $this->models = Model::orderBy('name', 'asc')->get();
        $this->fuels = Option::where('category_id',22)->get();
        $this->categories = Category::where('status',1)->where('type','CAR')->get();
        $this->min_price = Setting::where('key','min_price')->first()->value;
        $this->max_price = Setting::where('key','max_price')->first()->value;
    }

    public function index()
    {
      /*  $cid='10988864596711032484';
        $url = 'https://maps.googleapis.com/maps/api/place/details/json?cid='.$cid.'&key=<API-KEY>';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        curl_close($ch);

        $arrayData = json_decode($data, true); // json object to array conversion
        */
        $features = Feature::where('status',1)->get();
        $methodologies = Methodology::where('status',1)->get();
        $evaluations = Evaluation::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->where('type','CAR')->get();
        $products = Product::where('is_offer',0)->where('is_web',1)->where('status',1)->where('type','CAR')->orderBy('id', 'desc')->take(3)->get();
        $offers = Product::where('is_web',1)->where('status',1)->where('type','CAR')->where('is_offer',1)->orderBy('id', 'desc')->take(3)->get();
        return view('WEB.AR.index')->with('addresses',$this->addresses)
                                   ->with('settings',$this->settings)
                                   ->with('features',$features)
                                   ->with('methodologies',$methodologies)
                                   ->with('evaluations',$evaluations)
                                   ->with('brands',$brands)
                                   ->with('categories',$categories)
                                   ->with('offers',$offers)
                                   ->with('products',$products)
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
        $brands = Brand::where('status',1)->get();
        return view('WEB.AR.about')->with('addresses',$this->addresses)
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

        $products = Product::where('is_offer',0)->where('is_web',1)->where('status', 1)->where('type','CAR')
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

      return view('WEB.AR.cars')->with('products',$products)
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

        $products = Product::where('is_offer',0)->where('is_web',1)->where('status', 1)->where('type','CAR')
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

      return view('WEB.AR.cars')->with('products',$products)
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

      return view('WEB.AR.offers')->with('products',$products)
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

      return view('WEB.AR.offers')->with('products',$products)
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
        return view('WEB.AR.contact')->with('addresses',$this->addresses)
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
        return view('WEB.AR.offers')->with('addresses',$this->addresses)
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
        $products = Product::where('is_offer',0)->where('is_web',1)->where('status',1)->where('type','CAR')->orderBy('id', 'desc')->get();
        return view('WEB.AR.cars')->with('addresses',$this->addresses)
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

    public function export()
    {
        $products = ExportProduct::where('is_web',1)->where('status',1)->orderBy('id', 'desc')->get();

        return view('WEB.AR.export')->with('addresses',$this->addresses)
                                    ->with('settings',$this->settings)
                                    ->with('products',$products);
    }

    public function questions()
    {
        $questions= Faq::where('status',1)->where('lang','AR')->get();
        return view('WEB.AR.questions')->with('addresses',$this->addresses)
                                       ->with('settings',$this->settings)
                                       ->with('questions',$questions);
    }

    public function kmaliat()
    {
        return view('WEB.AR.kmaliat')->with('addresses',$this->addresses)
                                     ->with('settings',$this->settings);
    }

    public function learn()
    {
        $learns= Guide::where('status',1)->where('lang','AR')->get();
        return view('WEB.AR.learn')->with('addresses',$this->addresses)
                                   ->with('settings',$this->settings)
                                   ->with('learns',$learns);
    }

    public function privacy()
    {
        $privacy=Page::find(1);
        return view('WEB.AR.privacy')->with('addresses',$this->addresses)
                                     ->with('settings',$this->settings)
                                     ->with('privacy',$privacy);
    }

    public function condition()
    {
        $condition=Page::find(3);
        return view('WEB.AR.condition')->with('addresses',$this->addresses)
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

        return view('WEB.AR.single_car')->with('addresses',$this->addresses)
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
        return view('WEB.AR.single_export_car')->with('addresses',$this->addresses)->with('settings',$this->settings)
                                        ->with('product',$product);
    }

    public function evaluations()
    {
        $countries =Country::orderBy('name', 'asc')->get();
        $evaluations = Evaluation::where('status',1)->get();
        return view('WEB.AR.evaluations')->with('addresses',$this->addresses)
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
                    return redirect()->route('status',[$order->status]);

			}
		}

            session()->flash('error', 'خطأ في البيانات ، الرجاء المحاولة مرة آخرى');
            return redirect()->back();



    }
    public function status($id)
    {
        $status=TrackingStatus::find($id);
        if(is_null($status)){
              session()->flash('error', 'الصفحة غير متوفرة');
            return redirect()->back();
        }

                    return view('WEB.AR.status')->with('addresses',$this->addresses)
                    ->with('settings',$this->settings)
                    ->with('status',$status);




    }
public function tracking_view()
    {
                    return view('WEB.AR.tracking')->with('addresses',$this->addresses)
                    ->with('settings',$this->settings);

    }



public function order_view($id)
{
    $product =Product::find($id);
    if(!$product->count() || ($product->count() && ($product['quantity']) < 1)) {
        session()->flash('error', 'Out of stuck <br/> نفذت الكمية!');
      return redirect()->back();
    }
                return view('WEB.AR.user1')->with('product',$product)->with('addresses',$this->addresses)
                ->with('settings',$this->settings);

}

    public function new_order(Request $request){

		$product = Product::where('id', intval($request['product_id']));

        if(!$product->count() || ($product->count() && ($product->first()['quantity']) < 1)) {
            session()->flash('error', 'Out of stuck <br/> نفذت الكمية!');
          return redirect()->back();
        }
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
                    'deleted_at' => '2021-12-04 01:58:04',
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

            return view('WEB.AR.user2')->with('order',$order)->with('addresses',$this->addresses)
            ->with('settings',$this->settings);
        } else{

            session()->flash('error', 'Enter Valid data <br/> أدخل البيانات المطلوبة بشكل صحيح');
          return redirect()->back();
        }
    }
    public function paid_view(Request $request){
        return $this->paid($request);
        $order =Order::withTrashed()->find($request['order_id']);

        //dd($order);
        $result = Paytabs::getInstance()->create_pay_page(array(


            //Customer's Personal Information
            'cc_first_name' => "john",          //This will be prefilled as Credit Card First Name
            'cc_last_name' => "Doe",            //This will be prefilled as Credit Card Last Name
            'cc_phone_number' => "00973",
            'phone_number' => "33333333",
            'email' => "customer@gmail.com",

            //Customer's Billing Address (All fields are mandatory)
            //When the country is selected as USA or CANADA, the state field should contain a String of 2 characters containing the ISO state code otherwise the payments may be rejected.
            //For other countries, the state can be a string of up to 32 characters.
            'billing_address' => "manama bahrain",
            'city' => "manama",
            'state' => "manama",
            'postal_code' => "00973",
            'country' => "BHR",

            //Customer's Shipping Address (All fields are mandatory)
            'address_shipping' => "Juffair bahrain",
            'city_shipping' => "manama",
            'state_shipping' => "manama",
            'postal_code_shipping' => "00973",
            'country_shipping' => "BHR",

            //Product Information
            "products_per_title" => "Product1 || Product 2 || Product 4",   //Product title of the product. If multiple products then add “||” separator
            'quantity' => "1 || 1 || 1",                                    //Quantity of products. If multiple products then add “||” separator
            'unit_price' => "2 || 2 || 6",                                  //Unit price of the product. If multiple products then add “||” separator.
            "other_charges" => "4990.00",                                     //Additional charges. e.g.: shipping charges, taxes, VAT, etc.
            'amount' => $order->deposit,                                          //Amount of the products and other charges, it should be equal to: amount = (sum of all products’ (unit_price * quantity)) + other_charges
            'discount' => "0",                                                //Discount of the transaction. The Total amount of the invoice will be= amount - discount

            //Invoice Information
            'title' => "John Doe",               // Customer's Name on the invoice
            "reference_no" => $order->id,        //Invoice reference number in your system


        ));


        // dd($result);

        if ($result->response_code == 4012) {
            return redirect($result->payment_url);
        }
        if ($result->response_code == 4094) {
            return $result->details;
        }

        return $result->result;
       /* $order =Order::withTrashed()->find($request['order_id']);
        return view('WEB.AR.user3')->with('order',$order)->with('addresses',$this->addresses)
        ->with('settings',$this->settings);*/
    }
    
    
    /**
     * Edit The paid function becuase the online payment has been disabled
     */
    public function paid(Request $request){

        // $result = Paytabs::getInstance()->verify_payment($request->payment_reference);

// 		$order = Order::find($request->reference_no);
        $order = Order::withTrashed()->find($request['order_id']);
        // if ($result->response_code == 100) {
			$order->is_paid = 0;
// 			$order->paid_at = null;
			$order->save();
            Mail::send('emails.order', [
				'name'				=>	$order['name'],
				'email'				=>	$order['email'],
				'address'			=>	$order['address'],
				'tracking_number'	=>	$order['tracking_number'],
				'order_id'			=>	$order->id
			], function ($m) use ($order) {
				$m->from(env('MAIL_USERNAME','app@almaridcars.com') , 'Almarid Cars');
				$m->to(array_filter(explode(',', \Cache::store('file')->get('settings.email') . ',' . $order['email'])))->subject('طلب جديد ');
			});
            session()->flash('success', 'تم الحجز بنجاح ، تم ارسال كود التتبع على ايميلك');
            return redirect('/cars');
        // }
        // session()->flash('error', 'لم تتم عملية الدفع ، الرجاء المحاولة مرة أخرى');
        // return redirect()->route('car',[$order->product_id]);

    }
}
