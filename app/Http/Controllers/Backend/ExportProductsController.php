<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\ExportProduct;
use App\Models\ExportProductService;
use App\Models\ExportService;


class ExportProductsController extends BackendController {

    var $title = 'سيارات التصدير';
    var $route = 'export-cars';
    var $view_folder = 'export_products';
    var $upload_folder = 'products';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new ExportProduct();
        // $this->model2 = new WebExportProduct();
    }

    public function index(){
        $this->data['title'] = $this->title;
        $this->data['route'] = $this->route;
        $this->data['brands']   =   Brand::query()->select(['id' , 'name'])->get();
        $this->data['services'] = ExportService::get();
        return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
    }

    public function data(){
        $objects = $this->model->select('*');
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
            ->rawColumns(['status', 'edit_action','delete_action'])->toJson();
    }

    public function add(Request $request){
        $this->data = $request->all();
        $name = $this->data['name'];
        $name_en = $this->data['name_en'];
        $make = $this->data['make'];
        $year = $this->data['year'];
        $model = $this->data['model'];
        $price = $this->data['price'];
        $body_style = $this->data['body_style'];
        $stack_number = $this->data['stack_number'];
        $mileage = $this->data['mileage'];
        $loaction = $this->data['loaction'];
        $engine = $this->data['engine'];
        $door = $this->data['door'];
        $warranty = $this->data['warranty'];
        $bhp = $this->data['bhp'];
        $price_dollar = $this->data['price_dollar'];
        $phone = $this->data['phone'];
        $phone1 = $this->data['phone1'];
        $geer = $this->data['geer'];
        $wheel_drive = $this->data['wheel_drive'];
        $services = $this->data['services'];
        $status = TRUE;
        $brand_id   =   $this->data['brand_id'];
        $image_path = $this->uploadImage($request, 'image', $this->upload_folder);

        $object = $this->model->create([
            'name'=>$name,
            'name_en'=>$name_en,
            'make'=>$make,
            'year'=>$year,
            'model'=>$model,
            'price'=>$price,
            'body_style'=>$body_style,
            'stack_number'=>$stack_number,
            'mileage'=>$mileage,
            'loaction'=>$loaction,
            'engine'=>$engine,
            'door'=>$door,
            'warranty'=>$warranty,
            'bhp'=>$bhp,
            'price_dollar'=>$price_dollar,
            'phone'=>$phone,
            'phone1'=>$phone1,
            'image'=>$image_path,
            'geer'=>$geer,
            'wheel_drive'=>$wheel_drive,
            'status'=>$status,
            'brand_id'  => $brand_id,
        ]);

        if(isset($services) && !empty($services) && count($services) > 0){
            foreach ($services as $key => $value){
                ExportProductService::create([
                    'export_product_id' => $object->id,
                    'export_service_id' => $value
                ]);
            }
        }

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

        $name = $this->data['name'];
        $name_en = $this->data['name_en'];
        $make = $this->data['make'];
        $year = $this->data['year'];
        $model = $this->data['model'];
        $price = $this->data['price'];
        $body_style = $this->data['body_style'];
        $stack_number = $this->data['stack_number'];
        $mileage = $this->data['mileage'];
        $loaction = $this->data['loaction'];
        $engine = $this->data['engine'];
        $door = $this->data['door'];
        $warranty = $this->data['warranty'];
        $bhp = $this->data['bhp'];
        $price_dollar = $this->data['price_dollar'];
        $phone = $this->data['phone'];
        $phone1 = $this->data['phone1'];
        $geer = $this->data['geer'];
        $wheel_drive = $this->data['wheel_drive'];
        $services = $this->data['services'];
        $brand_id   =   $this->data['brand_id'];

        $object = $this->model->find($this->data['id']);
        $update = [
            'name'=>$name,
            'name_en'=>$name_en,
            'make'=>$make,
            'year'=>$year,
            'model'=>$model,
            'price'=>$price,
            'body_style'=>$body_style,
            'stack_number'=>$stack_number,
            'mileage'=>$mileage,
            'loaction'=>$loaction,
            'engine'=>$engine,
            'door'=>$door,
            'warranty'=>$warranty,
            'bhp'=>$bhp,
            'geer'=>$geer,
            'price_dollar'=>$price_dollar,
            'wheel_drive'=>$wheel_drive,
            'phone'=>$phone,
            'phone1'=>$phone1,
            'brand_id'      =>  $brand_id,
        ];


        if($request->hasFile('image')){
            $image_path = $this->uploadImage($request, 'image', $this->upload_folder);
            @unlink('uploads/'.$this->upload_folder.'/'.$object->image);
            $update['image'] = $image_path;
        }
        $object->update($update);


        if(isset($services) && !empty($services) && count($services) > 0){
            $servicesArray = [];
            foreach ($services as $key => $value){
                $pc = ExportProductService::where('export_product_id',$object->id)->where('export_service_id',$value)->first();
                if($pc) {
                    $servicesArray[] = $pc->id;
                }else{
                    $inserted = ExportProductService::create([
                        'export_product_id' => $object->id,
                        'export_service_id' => $value
                    ]);
                    $servicesArray[] = $inserted->id;
                }

            }
            ExportProductService::where('export_product_id',$object->id)->whereNotIn('id',$servicesArray)->delete();

}
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
            $this->data['upload_folder'] = $this->upload_folder;
            $this->data['export_product_service'] = ExportProductService::where('export_product_id',$request->input('id'))->pluck('export_service_id')->toArray();
            $this->data['brands']   =   Brand::query()->select(['id' , 'name'])->get();
            $this->data['services'] = ExportService::get();
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

            foreach( $this->model2->where('export_product_id',$id)->get() as $web){
                $deleted = $this->model2->destroy($web->id);
            }
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
