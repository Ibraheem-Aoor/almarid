<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Setting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends BackendController
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
    public function index()
    {
        $this->data['title'] = 'الاعدادات';
        $this->data['settings'] = Setting::all();
        return view('backend.settings.index')->with('data',$this->data);
    }

    public function update(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $settings_images = ['app_logo','splash_image'];
        foreach($inputs as $key => $input)
        {
            if(in_array($key,$settings_images)){
                continue;
            }
            Setting::where('key',$key)->update([
                'value' => $input
            ]);
        }
        foreach($settings_images as $image)
        {
            if($request->hasFile($image))
            {
                $filename = $request->file($image)->getClientOriginalName();
                $extension = $request->file($image)->getClientOriginalExtension();
                $fid = time();
                $sett = Setting::where('key',$image)->first();
                try{
                    @unlink('uploads/settings/'.$sett->value);
                }catch (Exception $exp){}
                $request->file($image)->move('uploads/settings/', $fid.'_'.$filename);
                $sett->update(['value' => $fid.'_'.$filename]);
            }
        }

        Artisan::call('optimize:clear');
        session()->flash('success','تمت العملية بنجاح');
        return \Redirect::back();
    }

}
