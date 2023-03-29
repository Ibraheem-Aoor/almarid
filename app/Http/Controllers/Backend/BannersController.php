<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Slider;


class BannersController extends BackendController {

	var $title = 'البنرات';
	var $route = 'banners';
	var $view_folder = 'banners';
	var $upload_folder = 'sliders';
	private $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new Slider();
	}

	public function index(Request $request){
		$this->data['title'] = $this->title;
		$this->data['route'] = $this->route;
		if($request->has('lang') && in_array($request->get('lang'),\Config::get('app.locales'))){
			$this->data['lang'] = $request->get('lang');
		}else{
			$this->data['lang'] = \Config::get('app.locale');
		}
		// $this->data['products'] = Product::where('status',1)->get();
		return view('backend/'.$this->view_folder.'/index')->with('data',$this->data);
	}

	public function data(Request $request){
		if($request->has('lang') && in_array($request->get('lang'),\Config::get('app.locales'))){
			$objects = $this->model->where('lang',$request->get('lang'))->select('*');
		}else{
			$objects = $this->model->select('*');
		}
		return \Datatables::of($objects)
			->addColumn('type', function ($object) {return __('site.' . $object['type']);})
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
//        $this->validate($request, [
//            'image' => 'required|mimes:jpg,png,gif,jpeg,mp4,ogx,oga,ogv,ogg,webm',
//        ]);
		$this->data = $request->all();
		$name = $this->data['name'];
		$lang = $this->data['lang'];
		$type = $this->data['type'];
		$status = TRUE;
		$image_path = $this->uploadImage($request, 'image', $this->upload_folder);

		// $product_id = $this->data['product_id'];
		// $type = 'IMAGE';
		// if(intval($product_id)>0) {
		//     $type = 'PRODUCT';
		// }

		$object = $this->model->create([
			'name'=>$name,
			'file'=>$image_path,
			'status'=>$status,
			'type'=>$type,
			// 'product_id'=>$product_id,
			'lang'=>$lang,
		]);

		if($object){
			$object_row = '';
			$object_row.= '<tr role="row">';
			$object_row.='<td class="text-center">'.$object->name.'</td>';
			$object_row.='<td class="text-center">'.__('site.' . $object['type']).'</td>';
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
//        $this->validate($request, [
//            'image' => 'mimes:jpg,png,gif,jpeg,mp4,ogx,oga,ogv,ogg,webm',
//        ]);
		$this->data = $request->all();
		$name = $this->data['name'];
		$lang = $this->data['lang'];
		$type = $this->data['type'];

		$object = $this->model->find($this->data['id']);

		// $product_id = $this->data['product_id'];
		// $type = 'IMAGE';
		// if(intval($product_id)>0) {
		//     $type = 'PRODUCT';
		// }
		$update = [
			'name'=>$name,
			'type'=>$type,
			// 'product_id'=>$product_id,
			'lang'=>$lang,
		];
		
		
		if($request->hasFile('image')){
			$image_path = $this->uploadImage($request, 'image', $this->upload_folder);
			@unlink('uploads/'.$this->upload_folder.'/'.$object->image);
            $update['file'] = $image_path;
		}
		
		$object->update($update);

		if($object){
			$object_row = '';
			$object_row.= '<tr role="row">';
			$object_row.='<td class="text-center">'.$object->name.'</td>';
			$object_row.='<td class="text-center">'.__('site.' . $object['type']).'</td>';
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
			$this->data['file_folder'] = $this->upload_folder;
			// $this->data['products'] = Product::where('status',1)->get();
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
