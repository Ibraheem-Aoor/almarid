<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Color;
use App\Models\ProductColorImage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WebProductColor;


class ProductsImagesController extends BackendController {

    var $title = 'ألوان وصور السيارات';
    var $route = 'webcars';
    var $view_folder = 'webcars';
    var $upload_folder = 'products';
    private $model = null;

    public function __construct(){
        parent::__construct();
        $this->model = new WebProductColor();
    }

    public function index(){
        $this->data['title'] = $this->title;
        $this->data['route'] = $this->route;
       $this->data['colors'] = Color::get();
       $this->data['products'] = Product::where('type', 'CAR')->get();
        return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
    }

    public function data(){
        $objects =  $this->model->select('*')->with('color')->with('product');
        return \Datatables::of($objects)
            ->addColumn('created_at', function ($object) {return date('Y-m-d',strtotime($object->created_at));})
            ->addColumn('color', function ($object) {return Color::find($object->color_id)->name;})
            ->addColumn('product', function ($object) {return Product::find($object->product_id)->name;})
            ->addColumn('edit_action', function ($object) {return '<a onclick="showModal('.$object->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a>';})
            ->addColumn('delete_action', function ($object) {return '<a onclick="deleteThis('.$object->id.')" id="'.$object->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a>';})
            ->rawColumns(['color','product', 'edit_action','delete_action'])->toJson();
    }
    public function add(Request $request){
        $this->data = $request->all();
        $color_id = $this->data['color_id'];
        $product_id = $this->data['product_id'];

        $object_product = Product::find($product_id);
        $update_product = [
            'is_web'=>1,
        ];
        $object_product->update($update_product);


        $object = $this->model->create([
            'color_id'=>$color_id,
            'product_id'=>$product_id,
        ]);

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $image)
            {
                $image_path = $this->uploadMultiImage($request, $image, $this->upload_folder);
                ProductColorImage::create([
                    'web_product_color_id' => $object->id,
                    'image' => $image_path
                ]);
            }
        }

        if($object){
            $object_row = '';
            $object_row.= '<tr role="row">';
            $object_row.='<td class="text-center">'.Product::find($object->product_id)->name.'</td>';
            $object_row.='<td class="text-center">'.Color::find($object->color_id)->name.'</td>';
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
        $color_id = $this->data['color_id'];
        $product_id = $this->data['product_id'];


        $object = $this->model->find($this->data['id']);
        $update = [
            'color_id'=>$color_id,
            'product_id'=>$product_id,
        ];
        $object->update($update);

        if($request->hasfile('images')) {
            foreach($request->file('images') as $image)
            {
                $image_path = $this->uploadMultiImage($request, $image, $this->upload_folder);
                ProductColorImage::create([
                    'web_product_color_id' => $object->id,
                    'image' => $image_path
                ]);
            }
        }


        if($object){
            $object_row = '';
            $object_row.= '<tr role="row">';
            $object_row.='<td class="text-center">'.Product::find($object->product_id)->name.'</td>';
            $object_row.='<td class="text-center">'.Color::find($object->color_id)->name.'</td>';

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
            $this->data['product_images'] = ProductColorImage::where('web_product_color_id',$request->input('id'))->get();
            $this->data['route'] = $this->route;
            $this->data['upload_folder'] = $this->upload_folder;
            $this->data['colors'] = Color::get();
            $this->data['products'] = Product::where('type', 'CAR')->get();
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
    public function delete_image(Request $request,$id){
        $this->data = $request->all();
        if(intval($id) > 0){
            $deletedRestaurant = ProductColorImage::find($id);
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
