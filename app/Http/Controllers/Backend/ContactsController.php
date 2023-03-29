<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Contact;
use Illuminate\Http\Request;


class ContactsController extends BackendController {

    var $title = 'تواصل معنا';
    var $route = 'contacts';
    var $view_folder = 'contacts';
    var $upload_folder = 'contacts';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new Contact();
    }

    public function index(Request $request){
        $this->data['title'] = $this->title;
        $this->data['route'] = $this->route;
        
        if($request->has('status')){
            $this->data['status'] = $request->get('status');
        }else{
            $this->data['status'] = 0;
        }
        return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
    }

    public function data(Request $request){
        $objects = $this->model;
        if($request->has('status')){
            $objects = $objects->where('status',$request->get('status'))->select('*');
        }else{

            $objects = $objects->select('*');
        }



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
                $is_active .= '<span class="box"></span>تمت المشاهدة';;
                $is_active .= '</label>';
            }
            else {
                //$is_active .= '<input type="checkbox" value="' . $object->id . '" id="checkbox33_' . $object->id . '" class="md-check">';
                $is_active .= '<label class="btn btn-danger"  onclick="ch_st(' . $object->id . ')" id="label_status_' . $object->id . '" for="checkbox33_' . $object->id . '">';
                $is_active .= '<span class="inc"></span>';
                $is_active .= '<span class="check"></span>';
                $is_active .= '<span class="box"></span>قيد الانتظار';
                $is_active .= '</label>';
            }
            $is_active .= '</div>';
            $is_active .= '</div>';
            return $is_active;
        })
            ->addColumn('created_at', function ($object) {return date('Y-m-d',strtotime($object->created_at));})
            ->addColumn('edit_action', function ($object) {return '<a onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-eye"></i></a>';})
            ->addColumn('delete_action', function ($object) {return '<a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a>';})
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
    
    
    public function delete(Request $request){
        $this->data = $request->all();
        $id = $this->data['id'];
        $deletedRestaurant = $this->model->destroy($id);
        if($deletedRestaurant){
            return response()->json([
                'success'=>TRUE,
                'deleted_Restaurant'=>TRUE,
                'restaurant_id' => $id
            ]);
        }
    }
    
    public function change_status(Request $request){
        $id = $request->get('id');
        $object = $this->model->find($id);
        if($object->status == 1){
            $object->update(['status'=>0]);
            $status = 'قيد الانتظار';
        }else{
            $object->update(['status'=>1]);
            $status = 'تمت المشاهدة';
        }

        
        return response()->json([
            'success'=>TRUE,
            'status' => $status
        ]);
    }
}
