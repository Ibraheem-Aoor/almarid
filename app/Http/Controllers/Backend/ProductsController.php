<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Model;
use App\Models\Option;
use App\Models\WebProductColor;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductsController extends BackendController {

    var $title = 'السيارات';
    var $route = 'cars';
    var $view_folder = 'products';
    var $upload_folder = 'products';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new Product();
        $this->model2 = new WebProductColor();
    }

    public function index(){
        $this->data['title'] = $this->title;
        $this->data['route'] = $this->route;
        $this->data['models'] = Model::get();
        $this->data['brands'] = Brand::where('status',1)->get();
        $this->data['colors'] = Color::get();
        $this->data['options'] = Option::where('status',1)->get();
        $this->data['categories'] = Category::where('status',1)->where('type','CAR')->get();
        $this->data['options_category'] = Category::where('status',1)->where('type','OPTIONS')->with('options')->get();
        return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
    }

    public function data(){
        $objects = $this->model->select('*')->where('type', 'CAR');
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
        $description = $this->data['description'];
        $description_en = $this->data['description_en'];
        $brand_id = $this->data['brand_id'];
        $model_id = $this->data['model_id'];
        $category_id = $this->data['category_id'];
        $price = $this->data['price'];

        $options = $this->data['options'];
        $colors = $this->data['colors'];

        $options_category = $this->data['options_category'];
        $input_type = $this->data['input_type'];

//        $is_offer = $this->data['is_offer'];
//        $offer_id = $this->data['offer_id'];
//        $offer_price = $this->data['offer_price'];
        $quantity = $this->data['quantity'] ?? 30;
        $deposit = $this->data['deposit'];
        $is_new = $this->data['is_new'];
        $status = TRUE;
        $image_path = $this->uploadImage($request, 'image', $this->upload_folder);

        $object = $this->model->create([
            'name'=>$name,
            'name_en'=>$name_en,
            'image'=>$image_path,
            'description'=>$description,
            'description_en'=>$description_en,
            'brand_id'=>$brand_id,
            'model_id'=>$model_id,
            'category_id'=>$category_id,
            'price'=>$price,
//            'is_offer'=>$is_offer,
//            'offer_id'=>$offer_id,
//            'offer_price'=>$offer_price,
            'quantity'=>$quantity,
            'deposit'=>$deposit,
            'status'=>$status,
            'is_new'=>$is_new,
        ]);

        if(isset($colors) && !empty($colors) && count($colors) > 0){
            foreach ($colors as $key => $value){
                ProductColor::create([
                    'product_id' => $object->id,
                    'color_id' => $value
                ]);
            }
        }
//        if(isset($options) && !empty($options) && count($options) > 0){
//            foreach ($options as $key => $value){
//                ProductOption::create([
//                    'product_id' => $object->id,
//                    'option_id' => $value
//                ]);
//            }
//        }
        if(isset($options_category) && !empty($options_category) && count($options_category) > 0){
            for ($i = 0 ; $i < count($options_category) ; $i++){
                if($input_type[$i] == 'select'){
                    ProductOption::create([
                        'product_id' => $object->id,
                        'option_category_id' => $options_category[$i],
                        'option_id' => $options[$i]
                    ]);
                }else{
                    ProductOption::create([
                        'product_id' => $object->id,
                        'option_category_id' => $options_category[$i],
                        'option_id' => 0,
                        'other' => $options[$i]
                    ]);
                }
            }
        }

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $image_path = $this->uploadMultiImage($request, $image, $this->upload_folder);
                ProductImage::create([
                    'product_id' => $object->id,
                    'image' => $image_path
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
        $description = $this->data['description'];
        $description_en = $this->data['description_en'];
        $brand_id = $this->data['brand_id'];
        $model_id = $this->data['model_id'];
        $category_id = $this->data['category_id'];
        $price = $this->data['price'];
        $quantity = $this->data['quantity'];
        $deposit = $this->data['deposit'];
        $is_new = $this->data['is_new'];

        $colors = $this->data['colors'];
        $options = $this->data['options'];

        $options_category = $this->data['options_category'];
        $input_type = $this->data['input_type'];


        $object = $this->model->find($this->data['id']);
        $update = [
            'name'=>$name,
            'name_en'=>$name_en,
            'description'=>$description,
            'description_en'=>$description_en,
            'brand_id'=>$brand_id,
            'model_id'=>$model_id,
            'category_id'=>$category_id,
            'price'=>$price,
            'quantity'=>$quantity,
            'deposit'=>$deposit,
            'is_new'=>$is_new,
        ];

        if($request->hasFile('image')){
            $image_path = $this->uploadImage($request, 'image', $this->upload_folder);
            @unlink('uploads/'.$this->upload_folder.'/'.$object->image);
            $update['image'] = $image_path;
        }
        $object->update($update);


        if(isset($colors) && !empty($colors) && count($colors) > 0){
            $colorsArray = [];
            foreach ($colors as $key => $value){
                $pc = ProductColor::where('product_id',$object->id)->where('color_id',$value)->first();
                if($pc) {
                    $colorsArray[] = $pc->id;
                }else{
                    $inserted = ProductColor::create([
                        'product_id' => $object->id,
                        'color_id' => $value
                    ]);
                    $colorsArray[] = $inserted->id;
                }

            }
            ProductColor::where('product_id',$object->id)->whereNotIn('id',$colorsArray)->delete();
        }
//        if(isset($options) && !empty($options) && count($options) > 0){
//            $optionsArray = [];
//            foreach ($options as $key => $value){
//                $po = ProductOption::where('product_id',$object->id)->where('option_id',$value)->first();
//                $optionsArray[] = $po->id;
//                $inserted = ProductOption::create([
//                    'product_id' => $object->id,
//                    'option_id' => $value
//                ]);
//                $optionsArray[] = $inserted->id;
//            }
//            ProductOption::where('product_id',$object->id)->whereNotIn('id',$optionsArray)->delete();
//        }

        if(isset($options_category) && !empty($options_category) && count($options_category) > 0){
            for ($i = 0 ; $i < count($options_category) ; $i++){
                if($input_type[$i] == 'select'){

                    $option = ProductOption::where('product_id',$object->id)->where('option_category_id',$options_category[$i])->first();
                    if($option){
                        $option->update(['option_id' => $options[$i]]);
                    }else{
                        ProductOption::create([
                            'product_id' => $object->id,
                            'option_category_id' => $options_category[$i],
                            'option_id' => $options[$i]
                        ]);
                    }
                }else{
                    $option = ProductOption::where('product_id',$object->id)->where('option_category_id',$options_category[$i])->first();
                    if($option){
                        $option->update(['other' => $options[$i]]);
                    }else{
                        ProductOption::create([
                            'product_id' => $object->id,
                            'option_category_id' => $options_category[$i],
                            'option_id' => 0,
                            'other' => $options[$i]
                        ]);
                    }
                }
            }
        }


        if($request->hasfile('images')) {
            foreach($request->file('images') as $image)
            {
                $image_path = $this->uploadMultiImage($request, $image, $this->upload_folder);
                ProductImage::create([
                    'product_id' => $object->id,
                    'image' => $image_path
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
                'update_object'=>TRUE,
                'object_row' => $object_row,
                'id' => $object->id
            ]);
        }

    }

    public function show_edit_form(Request $request){
        if($request->has('id')){
            $object = $this->model->find($request->input('id'));
            $this->data['product_color'] = ProductColor::where('product_id',$request->input('id'))->pluck('color_id')->toArray();
            $this->data['product_option'] = ProductOption::where('product_id',$request->input('id'))->pluck('option_id', 'option_category_id')->toArray();
            $this->data['product_option_other'] = ProductOption::where('product_id',$request->input('id'))->pluck('other', 'option_category_id')->toArray();
            $this->data['product_images'] = ProductImage::where('product_id',$request->input('id'))->get();

            $this->data['route'] = $this->route;
            $this->data['upload_folder'] = $this->upload_folder;
            $this->data['models'] = Model::get();
            $this->data['brands'] = Brand::where('status',1)->get();
            $this->data['colors'] = Color::get();
            $this->data['options'] = Option::where('status',1)->get();
            $this->data['options_category'] = Category::where('status',1)->where('type','OPTIONS')->with('options')->get();
            $this->data['categories'] = Category::where('status',1)->where('type','CAR')->get();
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
            foreach( $this->model2->where('product_id',$id)->get() as $web){
                $deleted = $this->model2->destroy($web->id);
            }

            return response()->json([
                'success'=>TRUE,
                'deleted_Restaurant'=>TRUE,
                'restaurant_id' => $id
            ]);
        }
    }
    public function delete_image(Request $request,$id){
        $this->data = $request->all();
        if(intval($id) > 0){
            $deletedRestaurant = ProductImage::find($id);
            if($deletedRestaurant){
                @unlink('uploads/'.$this->upload_folder.'/'.$deletedRestaurant->image);
                $deletedRestaurant->destroy($id);
                return response()->json([
                    'success'=>TRUE,
                    'deleted_Restaurant'=>TRUE,
                    'restaurant_id' => $id
                ]);
            }
        }else{
            return response()->json([
                'success'=>false,
                'deleted_Restaurant'=>false
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
