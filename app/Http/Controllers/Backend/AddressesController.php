<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Address;
use Illuminate\Http\Request;


class AddressesController extends BackendController {

    var $title = 'العناوين';
    var $route = 'addresses';
    var $view_folder = 'addresses';
    var $upload_folder = 'addresses';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new Address();
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
            ->addColumn('edit_action', function ($object) {return '<a onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a>';})
            ->addColumn('delete_action', function ($object) {return '<a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a>';})
//            ->make(true);
            ->rawColumns(['status', 'edit_action','delete_action'])->toJson();
    }

    public function add(Request $request){
       /* $this->validate($request, [
            'image' => 'mimes:jpg,png,gif,jpeg,mp4,ogx,oga,ogv,ogg,webm',
        ]);*/
        $this->data = $request->all();
        $branch = $this->data['branch'];
        $branch_en = $this->data['branch_en'];
        $address = $this->data['address'];
        $address_en = $this->data['address_en'];
        $fax = $this->data['fax'];
        $phonenumber = $this->data['phonenumber'];
        $lat = $this->data['lat'];
        $lng = $this->data['lng'];
        $map = $this->data['map'];
        $status = TRUE;
        

        $object = $this->model->create([
            'branch'=>$branch,
            'branch_en'=>$branch_en,
            'address'=>$address,
            'address_en'=>$address_en,
            'fax'=>$fax,
            'phonenumber'=>$phonenumber,
            'lat'=>$lat,
            'lng'=>$lng,
            'map'=>$map,
            'status'=>$status,
        ]);

        if($object){
            $object_row = '';
            $object_row.= '<tr role="row">';
            $object_row.='<td class="text-center">'.$object->branch.'</td>';
            $is_active = '';
            $is_active.='<div class="col-md-12">';
            $is_active.='<div class="md-checkbox" id="'.$object->id.'" >';
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

            $object_row.='<td class="text-center">'.$is_active.'</td>';

            $object_row.='<td class="text-center"><a href="#" onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a></td>';
            $object_row.='<td class="text-center"><a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a></td>';
            $object_row.='</tr>';

            return response()->json([
                'success'=>TRUE,
                'new_restaurant'=>TRUE,
                'object' => $object_row
            ]);
        }

    }

    public function update(Request $request){
        /*$this->validate($request, [
            'image' => 'mimes:jpg,png,gif,jpeg,mp4,ogx,oga,ogv,ogg,webm',
        ]);*/
        $this->data = $request->all();
        $branch = $this->data['branch'];
        $branch_en = $this->data['branch_en'];
        $address = $this->data['address'];
        $address_en = $this->data['address_en'];
        $fax = $this->data['fax'];
        $phonenumber = $this->data['phonenumber'];
        $lat = $this->data['lat'];
        $lng = $this->data['lng'];
        $map = $this->data['map'];

        $object = $this->model->find($this->data['id']);

        $update = [
            'branch'=>$branch,
            'branch_en'=>$branch_en,
            'address'=>$address,
            'address_en'=>$address_en,
            'fax'=>$fax,
            'phonenumber'=>$phonenumber,
            'lat'=>$lat,
            'lng'=>$lng,
            'map'=>$map,
        ];
        $object->update($update);

        if($object){
            $object_row = '';
            $object_row.= '<tr role="row">';
            $object_row.='<td class="text-center">'.$object->branch.'</td>';
            $is_active = '';
            $is_active.='<div class="col-md-12">';
            $is_active.='<div class="md-checkbox" id="'.$object->id.'" >';
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

            $object_row.='<td class="text-center">'.$is_active.'</td>';

            $object_row.='<td class="text-center"><a href="#" onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a></td>';
            $object_row.='<td class="text-center"><a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a></td>';
            $object_row.='</tr>';

            return response()->json([
                'success'=>TRUE,
                'update_object'=>TRUE,
                'object_row' => $object_row,
                'id' => $object->id
            ]);
        }

    }

    public function show_edit_form(Request $request){
        if($request->has('id')){
            $object = $this->model->find($request->input('id'));
            $this->data['route'] = $this->route;
            return response()->json([
                    'success' => TRUE,
                    'page' => view('backend/'.$this->view_folder.'/edit')
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

    
}
