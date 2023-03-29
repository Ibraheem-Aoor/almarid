<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Evaluation;
use Illuminate\Http\Request;


class EvaluationsController extends BackendController {

    var $title = 'التقييمات';
    var $route = 'evaluations';
    var $view_folder = 'evaluations';
    var $upload_folder = 'evaluations';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new Evaluation();
    }

    public function index(Request $request){
        $this->data['title'] = $this->title;
        $this->data['route'] = $this->route;
        if($request->has('lang') && in_array($request->get('lang'),\Config::get('app.locales'))){
            $this->data['lang'] = $request->get('lang');
        }else{
            $this->data['lang'] = \Config::get('app.locale');
        }
        return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
    }

    public function data(Request $request){
        $objects = $this->model;
        if($request->has('lang') && in_array($request->get('lang'),\Config::get('app.locales'))){
            $objects = $objects->where('lang',$request->get('lang'));
        }

        $objects = $objects->select('*');


        return \Datatables::of($objects)
            ->addColumn('status', function ($object) {
                $is_active = '';
                $is_active.='<div class="col-md-12">';
                $is_active.='<div class="md-checkbox">';
                if($object->status == TRUE) {
                    //$is_active .= '<input type="checkbox" value="' . $object->id . '" checked id="checkbox33_' . $object->id . '" class="md-check">';
                    $is_active .= '<label class="btn btn-success"  onclick="ch_st(' . $object->id . ')" id="label_status_' . $object->id . '" for="checkbox33_' . $object->id . '">';
                    $is_active .= '<span class="inc"></span>';
                    $is_active .= '<span class="check"></span>';
                    $is_active .= '<span class="box"></span>مفعل';;
                    $is_active .= '</label>';
                }
                else {
                    //$is_active .= '<input type="checkbox" value="' . $object->id . '" id="checkbox33_' . $object->id . '" class="md-check">';
                    $is_active .= '<label class="btn btn-danger"  onclick="ch_st(' . $object->id . ')" id="label_status_' . $object->id . '" for="checkbox33_' . $object->id . '">';
                    $is_active .= '<span class="inc"></span>';
                    $is_active .= '<span class="check"></span>';
                    $is_active .= '<span class="box"></span>تفعيل؟';
                    $is_active .= '</label>';
                }
                $is_active .= '</div>';
                $is_active .= '</div>';
                return $is_active;
            })
            ->addColumn('created_at', function ($object) {return date('Y-m-d',strtotime($object->created_at));})
            ->addColumn('edit_action', function ($object) {return '<a onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-eye"></i></a>';})
           // ->addColumn('delete_action', function ($object) {return '<a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a>';})
//            ->make(true);
            ->rawColumns(['status', 'edit_action','delete_action'])->toJson();
    }


    public function show_edit_form(Request $request){
        if($request->has('id')){
            $object = $this->model->find($request->input('id'));
            $this->data['route'] = $this->route;
            $this->data['file_folder'] = $this->upload_folder;
            return response()->json([
                    'success' => TRUE,
                    'page' => view('backend/'.$this->view_folder.'/show')
                        ->with('data',$this->data)
                        ->with('object',$object)
                        ->render()
                ]
            );
        }
    }
    
    public function change_status(Request $request){
        $id = $request->get('id');
        $object = $this->model->find($id);
        if($object->status == 1){
            $object->update(['status'=>0]);
            $status = 'تفعيل؟';
        }else{
            $object->update(['status'=>1]);
            $status = 'مفعل';
        }
        return response()->json([
            'success'=>TRUE,
            'status' => $status
        ]);
    }

}
