<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Setting;
use Illuminate\Http\Request;

class NotificationsController extends BackendController
{
    // var $app_id = '69809ab1-a66e-4428-aa92-42a21a91fdda';
    // var $api_key = 'MzI5MGMyOGEtMzBlZS00NTY3LWI5NjktNGM0YmRhMTIzMzcz';
    var $app_id = '374838ee-fc86-4ec0-9bcc-c231df4f6082';
    var $api_key = 'N2NiNGJjMTAtOGU3YS00ZTdhLWJjNDEtZjZiZmE5MWFjMDgy';
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
    public function index()
    {
        $this->data['title'] = 'الاشعارات';
        return view('backend.notifications.index')->with('data',$this->data);
    }



    function send(Request $request){
        $title = $request->get('title');
        $message = $request->get('message');
        $heading = array(
            "en" => $title    //title
        );
        $content = array(
            "en" => $message   // message
        );

        $fields = array(
            'app_id' => $this->app_id,  //app_id
            'included_segments' => array('All'),
            'data' => array("title" => $title,"message" => $message ),
            'large_icon' =>"ic_launcher_round.png",
            'contents' => $content,
            'headings' => $heading
        );

        $fields = json_encode($fields);
        

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$this->api_key));  //app_key
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

//        dd($response);
//        \Session::flash('success','تمت العملية بنجاح');
        return \Redirect::back()->with('success','تمت العملية بنجاح');
    }
}
