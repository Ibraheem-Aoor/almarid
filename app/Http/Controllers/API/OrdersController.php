<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\TrackingStatus;
use App\Transformers\CategoryTransformer;
use App\Transformers\TrackingStatusTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

define("AUTHENTICATION", "https://www.paytabs.com/apiv2/validate_secret_key");
define("PAYPAGE_URL", "https://www.paytabs.com/apiv2/create_pay_page");
define("VERIFY_URL", "https://www.paytabs.com/apiv2/verify_payment");

class OrdersController extends BaseController
{

    private $merchant_email = 'moh.bashiti7@gmail.com';
    private $secret_key = "6XT1DXMfzkpScAKQ89smO6GpS2UrWBP2yJ4cHRrgcR9osTeB3HXSNEhGHc7DOXGnHLAoD2FPTOdmIsXMaVEYzWFh8MVWKCkrnUP1";

    /**
     * Create a new controller instance.
     */
    public function __construct(){
        
    }

	public function pay_page(Request $request, $tracking_number) {
		if (!Order::where('tracking_number', $tracking_number)->count()) {
			return 'يرجى التأكد من بيانات الطلب';
		}

		$order =	Order::where('tracking_number', $tracking_number)->first();

		if (isset($request['paid_now']) && ($request['paid_now'] == 1)) {
			return 'تم دفع المبلغ بنجاح, يمكنك اغلاق النافذة الان';
		}

		if ($order->is_paid == 1) {
			return 'تم الدفع للطلب مسبقاً!';
		}
		
		return view('order_payment.pay_page', compact('order'));
	}

	public function pay_result(Request $request) {
		if ($request['result'] == 'success') {
			$order = Order::find($request['order_id']);
			$order->is_paid = 1;
			$order->paid_at = Carbon::now();
			$order->save();

			/****************************************************************************/
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
			/***************************************************************************/
            $result = 'تم دفع المبلغ بنجاح, يمكنك اغلاق النافذة الان';
            
			return redirect()->route('order_payment.pay_page', ['tracking_number' => $order['tracking_number'], 'paid_now' => 1]);
    		return view('order_payment.payment_result', compact('result'));
			return redirect()->route('order_payment.payment_result', ['order_id' => 'order_id', 'result' => $result]);
			return 'تم دفع المبلغ بنجاح, يمكنك اغلاق النافذة الان';
		} else {
			$order = Order::find($request['order_id']);
			
// 			return $order;

			$product = Product::find(intval($order['product_id']));
			Product::where('id',intval($product['id']))->update(['quantity' => (intval($product->quantity) + 1 ) ]);

			$order->delete();
			
            $result = 'نعتذر, لقد تم الغاء طلبك نظرا لعدم اتمام عملية الدفع!';
            
    		return view('order_payment.payment_result', compact('result'));

			return view('order_payment.payment_result', ['result' => 'نعتذر, لقد تم الغاء طلبك نظرا لعدم اتمام عملية الدفع!']);
			return 'نعتذر, لقد تم الغاء طلبك نظرا لعدم اتمام عملية الدفع!';
			return redirect()->route('api_pay_page', ['tracking_number' => Order::find($request['order_id'])['tracking_number']]);
		}

		$order =	Order::find($id);

		return view('order_payment.pay_page', compact('order'));
	}

	public function tracking(Request $request){
		if($request->has('tracking_number') && $request->has('email') && filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){
			$order = Order::where('email', $request->get('email'))->where('tracking_number', $request->get('tracking_number'))->first();
			
			if($order){
				$tracking = TrackingStatus::where('id', $order->status)->get();
				if(count($tracking->toArray())){
					$data = $this->sendData($tracking,new TrackingStatusTransformer(),'tracking',false);
					if (count($data['tracking'])) {
						array_push($data['tracking'], [
							'order' => [
								'tracking_number' => $order->tracking_number,
								'is_paid' => $order->is_paid,
								'paid_at' => $order->paid_at,
							]
						]);
					}
					return $this->sendResponse(true,'success get Data',$data);
				} else{
//                    return $this->sendResponse(false,'Record '.$request->get('id').' Not Found',null,404);
					return $this->sendResponse(false,$request->get('id').' '.trans('site.not_complete'),null,404);
				}
			}
		}
		return $this->sendResponse(false,'Enter Valid Data',null,500);

	}

    public function new_order(Request $request){

		$product = Product::where('id', intval($request['product_id']));

        if(!$product->count() || ($product->count() && ($product->first()['quantity']) < 1)) {
            return $this->sendResponse(false,'Out of stuck <br/> نفذت الكمية!',null,500);
        }
        if($request->has('name') && $request->has('last_name') && $request->has('email') && filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) && $request->has('mobile') && $request->has('product_id')){
            $name = $request->get('name');
			$last_name = $request->get('last_name');
            $email = $request->get('email');
            $mobile = $request->get('mobile');
            $product_id = $request->get('product_id');
            $color_id = $request->get('color_id');

            $address = '';
            if($request->has('address')){
                $address = $request->get('address');
            }

            $long = '';
            if($request->has('long')){
                $long = $request->get('long');
            }

            $lat = '';
            if($request->has('lat')){
                $lat = $request->get('lat');
            }

            $product = Product::find(intval($product_id));
            $deposit = 0;
            $price = 0;
            $offer_price = 0;
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
                ]);
                $tracking_number = $order->id.$product_id.substr(str_shuffle("0123456789"), 0, 3);
                $order->update([
                    'tracking_number' => $tracking_number
                ]);


                Product::where('id',intval($product_id))->update(['quantity' => (intval($product->quantity) - 1 ) ]);
            }else{
                return $this->sendResponse(false,'Enter Valid Product',null,500);
            }
            
            return $this->sendResponse(true,'success add order',null,200,null,$tracking_number);
        } else{
            return $this->sendResponse(false,'Enter Valid data <br/> أدخل البيانات المطلوبة بشكل صحيح',null,500);
        }
    }









    function authentication(){
        $obj = json_decode($this->runPost(AUTHENTICATION, array("merchant_email"=> $this->merchant_email, "secret_key"=>  $this->secret_key)),TRUE);

        if($obj->response_code == "4000"){
            return TRUE;
        }
        return FALSE;

    }

    function create_pay_page($values) {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['ip_customer'] = $_SERVER['REMOTE_ADDR'];
        $values['ip_merchant'] = $_SERVER['SERVER_ADDR'];
        return json_decode($this->runPost(PAYPAGE_URL, $values));
    }



    function verify_payment($payment_reference){
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['payment_reference'] = $payment_reference;
        return json_decode($this->runPost(VERIFY_URL, $values));
    }

    function runPost($url, $fields) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];

        $ip_address = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

}
