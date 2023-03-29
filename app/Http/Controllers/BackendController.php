<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    var $data = [];
    var $originalName = NULL;
    var $width = NULL;
    var $height = NULL;
    var $size = NULL;

    protected $uploadsPath;


    public function __construct()
    {
        $this->middleware('auth');
/*
        $route = '';
        if(!empty(\Request::segment(2)) && !ctype_digit(\Request::segment(2)) && !preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', \Request::segment(2))){
            $route .= \Request::segment(2);
        }
        if(!empty(\Request::segment(3))  && !ctype_digit(\Request::segment(3))&& !preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', \Request::segment(3))){
            $route .= '-'.\Request::segment(3);
        }
        if(!empty(\Request::segment(4))  && !ctype_digit(\Request::segment(4))&& !preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', \Request::segment(4))){
            $route .= '-'.\Request::segment(4);
        }
        if(!empty(\Request::segment(5))  && !ctype_digit(\Request::segment(5))&& !preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', \Request::segment(5))){
            $route .= '-'.\Request::segment(5);
        }
        ini_set('xdebug.max_nesting_level', 200);
        try{
            if(\Auth::check()){
                if (isset($route) && !empty($route) && $route != null) {
                    if(\Auth::user()->can($route)){
                    }else{
                        \Redirect::to('/')->send();
                    }
                }else{
                    \Redirect::to('/')->send();
                }
            }else{
                \Redirect::to('/')->send();
            }
        }catch(\Exception $ex){
            \Redirect::to('/')->send();
        }
*/
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

    public function uploadImageOrVideo(Request $request,$image_video_name = 'image',$folder_name = 'images'){
        if($request->hasFile($image_video_name)){
            $this->originalName = \Input::file($image_video_name)->getClientOriginalName();
            $extension = \Input::file($image_video_name)->getClientOriginalExtension();
            $onlyName = explode('.'.$extension,$this->originalName);
            $fid = time();
            \Input::file($image_video_name)->move('uploads/'.$folder_name, $fid.'.'.$extension);
            $imgpath = $fid.'.'.$extension;
            return $imgpath;
        }else{
            return NULL;
        }
    }

    public function uploadMultiImage(Request $request,$image,$folder_name = 'images'){
            $this->originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $onlyName = explode('.'.$extension,$this->originalName);
            $fid = time();
            $imgpath = $fid.'_'.$onlyName[0].'.'.$extension;
            $image->move('uploads/'.$folder_name, $imgpath);
            return $imgpath;
    }


}
