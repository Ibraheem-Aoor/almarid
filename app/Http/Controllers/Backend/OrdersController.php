<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Category;
use App\Models\Option;
use App\Models\Order;
use App\Models\TrackingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class OrdersController extends BackendController {

    var $title = 'الطلبات';
    var $route = 'orders';
    var $view_folder = 'orders';
    var $upload_folder = 'orders';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new Order();
    }

    public function index(Request $request){
        $this->data['title'] = $this->title;
        $this->data['route'] = $this->route;
        return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
    }

    public function data(Request $request){
    	if ($request['order_status']) {
	        $objects = $this->model->with('product','tracking')->orderBy('created_at','desc')->select('*')->where('status', $request['order_status']);
    	} else {
	        $objects = $this->model->with('product','tracking')->orderBy('created_at','desc')->select('*');
    	}


        return \Datatables::of($objects)
            ->addColumn('product_name', function ($object) {
//                $is_active = '';
//                $is_active.='<div class="col-md-12">';
//                $is_active.='<div class="md-checkbox">';
//                if($object->status == TRUE) {
//                    //$is_active .= '<input type="checkbox" value="' . $object->id . '" checked id="checkbox33_' . $object->id . '" class="md-check">';
//                    $is_active .= '<label class="btn btn-success"  onclick="ch_st(' . $object->id . ')" id="label_status_' . $object->id . '" for="checkbox33_' . $object->id . '">';
//                    $is_active .= '<span class="inc"></span>';
//                    $is_active .= '<span class="check"></span>';
//                    $is_active .= '<span class="box"></span>مفعل';;
//                    $is_active .= '</label>';
//                }
//                else {
//                    //$is_active .= '<input type="checkbox" value="' . $object->id . '" id="checkbox33_' . $object->id . '" class="md-check">';
//                    $is_active .= '<label class="btn btn-danger"  onclick="ch_st(' . $object->id . ')" id="label_status_' . $object->id . '" for="checkbox33_' . $object->id . '">';
//                    $is_active .= '<span class="inc"></span>';
//                    $is_active .= '<span class="check"></span>';
//                    $is_active .= '<span class="box"></span>تفعيل؟';
//                    $is_active .= '</label>';
//                }
//                $is_active .= '</div>';
//                $is_active .= '</div>';
//                return $is_active;
                if(isset($object->product) && !empty($object->product)) {
                    return $object->product->name;
                }else{
                    return '<span style="color: #f00;">منتج محذوف او معطل</span>';
                }
            })->addColumn('tracking', function ($object) {
                if(isset($object->tracking) && !empty($object->tracking)) {
                    $alert_type = '';
                    if ($object->tracking->id == 1) {
                        $alert_type = '<a class="btn btn-primary">'. $object->tracking->name .'</a>';
                    } elseif ($object->tracking->id == 2) {
                        $alert_type = '<a class="btn btn-warning">'. $object->tracking->name .'</a>';
                    } elseif ($object->tracking->id == 3) {
                        $alert_type = '<a class="btn btn-success">'. $object->tracking->name .'</a>';
                    } else {
                        $alert_type = '<a class="btn btn-danger">'. $object->tracking->name .'</a>';
                    }
                    return $alert_type;
                }else{
                    return '<span style="color: #ffca18;">قيد الانتظار</span>';
                }
            })
            ->addColumn('created_at', function ($object) {return date('Y-m-d',strtotime($object->created_at));})
            ->addColumn('edit_action', function ($object) {return '<a onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a>';})
            ->addColumn('delete_action', function ($object) {return '<a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a>';})
//            ->make(true);
            ->rawColumns(['status', 'edit_action','delete_action','product_name','tracking'])->toJson();
    }

    public function add(Request $request){
        $this->validate($request, [
            'image' => 'mimes:jpg,png,gif,jpeg,mp4,ogx,oga,ogv,ogg,webm',
        ]);
        $this->data = $request->all();
        $name = $this->data['name'];
        $name_en = $this->data['name_en'];
        $category_id = $this->data['category_id'];
        $status = TRUE;
        $image_path = '';
        if($request->hasFile('image')) {
            $image_path = $this->uploadImage($request, 'image', $this->upload_folder);
        }

        $object = $this->model->create([
            'name'=>$name,
            'name_en'=>$name_en,
            'category_id'=>$category_id,
            'image'=>$image_path,
            'status'=>$status,
        ]);

        if($object){
            $object_row = '';
            $object_row.= '<tr role="row">';
            $object_row.='<td class="text-center">'.$object->name.'</td>';
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
        $this->data = $request->all();
        $status = $this->data['status'];

        $object = $this->model->find($this->data['id']);
        $update = [
            'status'=>$status,
        ];
        $object->update($update);
        return Redirect::back();
       /* if($object){
            $object_row = '';
            $object_row.= '<tr role="row">';
            $object_row.='<td class="text-center">'.$object->name.'</td>';
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
        }*/

    }

    public function show_edit_form(Request $request){
        if($request->has('id')){
            $object = $this->model->with('product','tracking')->find($request->input('id'));
            $this->data['route'] = $this->route;
            $this->data['file_folder'] = $this->upload_folder;
            $this->data['tracking_status'] = TrackingStatus::where('status',1)->get();
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

    public function check_name(Request $request){
        $name = $request->input('name');
        $id = $request->input('id');
        if (intval($id) > 0){
            $check = $this->model->where('id','<>', $id)->where('name', $name)->whereNull('deleted_at')->first();
        }else{
            $check = $this->model->where('name', $name)->whereNull('deleted_at')->first();
        }
        return response()->json(array(
            'valid' => is_null($check),
        ));
    }
}
