<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class AdministratorsController extends BackendController {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        return view('backend/administrators/administrators')->with('data',$this->data);
    }

    public function data(){
        $administrators = User::select('*');
        return \Datatables::of($administrators)
            ->addColumn('status', function ($admin) {
                $is_active = '';
                $is_active.='<div class="col-md-12">';
                $is_active.='<div class="md-checkbox"  id="'.$admin->id.'">';
                if($admin->status == TRUE) {
                    $is_active .= '<input type="checkbox" value="' . $admin->id . '" checked id="checkbox33_' . $admin->id . '" class="md-check">';
                    $is_active .= '<label onclick="ch_st(' . $admin->id . ')" id="label_status_' . $admin->id . '" for="checkbox33_' . $admin->id . '">';
                    $is_active .= '<span class="inc"></span>';
                    $is_active .= '<span class="check"></span>';
                    $is_active .= '<span class="box"></span>مفعل';;
                    $is_active .= '</label>';
                }
                else {
                    $is_active .= '<input type="checkbox" value="' . $admin->id . '" id="checkbox33_' . $admin->id . '" class="md-check">';
                    $is_active .= '<label onclick="ch_st(' . $admin->id . ')" id="label_status_' . $admin->id . '" for="checkbox33_' . $admin->id . '">';
                    $is_active .= '<span class="inc"></span>';
                    $is_active .= '<span class="check"></span>';
                    $is_active .= '<span class="box"></span>تفعيل؟';
                    $is_active .= '</label>';
                }
                $is_active .= '</div>';
                $is_active .= '</div>';
                return $is_active;
            })
            ->addColumn('created_at', function ($admin) {return date('Y-m-d',strtotime($admin->created_at));})
            ->addColumn('edit_action', function ($admin) {return '<a onclick="showModal('.$admin->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a>';})
            ->addColumn('delete_action', function ($admin) {return '<a onclick="deleteThis('.$admin->id.')" id="'.$admin->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a>';})
//            ->make(true);
            ->rawColumns(['status', 'edit_action','delete_action'])->toJson();
    }

    public function add(Request $request){
        $this->data = $request->all();
        $name = $this->data['name'];
//        $username = $this->data['username'];
        $email = $this->data['email'];
//        $mobile = $this->data['mobile'];
//        $role = $this->data['role'];
        $password = $this->data['password'];
        $password = \Hash::make($password);
        $status = TRUE;
        
        $admin = User::create([
            'name'=>$name,
//            'username'=>$username,
            'email'=>$email,
//            'role_id'=>$role,
//            'mobile'=>$mobile,
            'password'=>$password,
            'status'=>$status,
        ]);


        if (!empty($role)){
            $admin->attachRole($role);
        }
        //$user->detachRole($admin);

        if($admin){
            $admin_row = '';
            $admin_row.= '<tr role="row">';
            $admin_row.='<td class="text-center"  id="'.$admin->id.'" >'.$admin->name.'</td>';
            $admin_row.='<td class="text-center">'.$admin->username.'</td>';            
            $admin_row.='<td class="text-center">'.$admin->email.'</td>';

            $is_active = '';
            $is_active.='<div class="col-md-12">';
            $is_active.='<div class="md-checkbox">';
            if($admin->status == TRUE) {
                $is_active .= '<input type="checkbox" value="' . $admin->id . '" checked id="checkbox33_' . $admin->id . '" class="md-check">';
                $is_active .= '<label onclick="ch_st(' . $admin->id . ')" id="label_status_' . $admin->id . '" for="checkbox33_' . $admin->id . '">';
                $is_active .= '<span class="inc"></span>';
                $is_active .= '<span class="check"></span>';
                $is_active .= '<span class="box"></span>مفعل';;
                $is_active .= '</label>';
            }
            else {
                $is_active .= '<input type="checkbox" value="' . $admin->id . '" id="checkbox33_' . $admin->id . '" class="md-check">';
                $is_active .= '<label onclick="ch_st(' . $admin->id . ')" id="label_status_' . $admin->id . '" for="checkbox33_' . $admin->id . '">';
                $is_active .= '<span class="inc"></span>';
                $is_active .= '<span class="check"></span>';
                $is_active .= '<span class="box"></span>تفعيل؟';
                $is_active .= '</label>';
            }
            $is_active .= '</div>';
            $is_active .= '</div>';

            $admin_row.='<td class="text-center">'.$is_active.'</td>';

            $admin_row.='<td class="text-center">'.date('Y-m-d',strtotime($admin->dt_created_date)).'</td>';


            $admin_row.='<td class="text-center"><a href="#" onclick="showModal('.$admin->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a></td>';
            $admin_row.='<td class="text-center"><a onclick="deleteThis('.$admin->id.')" id="'.$admin->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a></td>';
            $admin_row.='</tr>';

            return response()->json([
                'success'=>TRUE,
                'new_restaurant'=>TRUE,
                'administrator' => $admin_row
            ]);
        }

    }

    public function update(Request $request){
        $this->data = $request->all();
        $name = $this->data['name'];
//        $username = $this->data['username'];
        $email = $this->data['email'];
//        if (isset($this->data['mobile']) && !empty($this->data['mobile'])){
//            $mobile = $this->data['mobile'];
//        }else{
//            $mobile = '';
//        }
//        $role = $this->data['role'];



        $admin = User::find($this->data['id']);
        if($request->has('password')) {
            $password = $this->data['password'];
            $password = \Hash::make($password);
        }
        else
            $password = $admin->password;

        $update = [
            'name'=>$name,
//            'username'=>$username,
//            'mobile'=>$mobile,
            'email'=>$email,
            'password'=>$password,
//            'role_id'=>$role,
        ];

        $admin->update($update);


        if (!empty($role)){
            $admin->roles()->sync([]);
            $admin->attachRole($role);
        }

        if($admin){
            $admin_row = '';
            $admin_row.= '<tr role="row">';
            $admin_row.='<td class="text-center" id="'.$admin->id.'">'.$admin->name.'</td>';
            $admin_row.='<td class="text-center">'.$admin->username.'</td>';
            $admin_row.='<td class="text-center">'.$admin->email.'</td>';

            $is_active = '';
            $is_active.='<div class="col-md-12">';
            $is_active.='<div class="md-checkbox">';
            if($admin->status == TRUE) {
                $is_active .= '<input type="checkbox" value="' . $admin->id . '" checked id="checkbox33_' . $admin->id . '" class="md-check">';
                $is_active .= '<label onclick="ch_st(' . $admin->id . ')" id="label_status_' . $admin->id . '" for="checkbox33_' . $admin->id . '">';
                $is_active .= '<span class="inc"></span>';
                $is_active .= '<span class="check"></span>';
                $is_active .= '<span class="box"></span>مفعل';;
                $is_active .= '</label>';
            }
            else {
                $is_active .= '<input type="checkbox" value="' . $admin->id . '" id="checkbox33_' . $admin->id . '" class="md-check">';
                $is_active .= '<label onclick="ch_st(' . $admin->id . ')" id="label_status_' . $admin->id . '" for="checkbox33_' . $admin->id . '">';
                $is_active .= '<span class="inc"></span>';
                $is_active .= '<span class="check"></span>';
                $is_active .= '<span class="box"></span>تفعيل؟';
                $is_active .= '</label>';
            }
            $is_active .= '</div>';
            $is_active .= '</div>';

            $admin_row.='<td class="text-center">'.$is_active.'</td>';

            $admin_row.='<td class="text-center">'.date('Y-m-d',strtotime($admin->dt_created_date)).'</td>';

            $admin_row.='<td class="text-center"><a href="#" onclick="showModal('.$admin->id.')" class="btn btn-info btn-social-icon"><i class="fa fa-edit"></i></a></td>';
            $admin_row.='<td class="text-center"><a onclick="deleteThis('.$admin->id.')" id="'.$admin->id.'" class="btn btn-danger btn-social-icon"><i class="fa fa-trash-o"></i></a></td>';
            $admin_row.='</tr>';

            return response()->json([
                'success'=>TRUE,
                'update_administrator'=>TRUE,
                'administrator_row' => $admin_row,
                'id' => $admin->id
            ]);
        }

    }

    public function show_edit_form(Request $request){
        if($request->has('id')){
            $admin = User::find($request->input('id'));
            $roles = Role::whereNotIn('id',[1,2])->get();
            return response()->json([
                    'success' => TRUE,
                    'page' => view('backend/administrators/edit')->with('roles',$roles)->with('administrator',$admin)->render()
                ]
            );
        }
    }

    public function change_status(Request $request){
        $id = $request->get('id');
        $admin = User::find($id);
        if($admin->status == 1){
            $admin->update(['status'=>0]);
            $status = 'تفعيل؟';
        }else{
            $admin->update(['status'=>1]);
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
        $deletedRestaurant = User::destroy($id);
        if($deletedRestaurant){
            return response()->json([
                'success'=>TRUE,
                'deleted_Restaurant'=>TRUE,
                'restaurant_id' => $id
            ]);
        }
    }

    public function random_string($type = 'alnum', $len = 8)
    {
        switch($type)
        {
            case 'basic'	: return mt_rand();
                break;
            case 'alnum'	:
            case 'numeric'	:
            case 'nozero'	:
            case 'alpha'	:

                switch ($type)
                {
                    case 'alpha'	:	$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'	:	$pool = '0123456789';
                        break;
                    case 'nozero'	:	$pool = '123456789';
                        break;
                }

                $str = '';
                for ($i=0; $i < $len; $i++)
                {
                    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
                }
                return $str;
                break;
            case 'unique'	:
            case '\Hash::make'		:

                return \Hash::make(uniqid(mt_rand()));
                break;
            case 'encrypt'	:
            case 'sha1'	:

                $CI =& get_instance();
                $CI->load->helper('security');

                return do_hash(uniqid(mt_rand(), TRUE), 'sha1');
                break;
        }
    }

    public function check_email(Request $request){
        $email = $request->input('email');
        $check_email = User::where('email', $email)->whereNull('deleted_at')->first();
        return response()->json(array(
            'valid' => is_null($check_email),
        ));
    }

    public function check_name(Request $request){
        $username = $request->input('username');
        $check_user = User::where('username', $username)->whereNull('deleted_at')->first();
        return response()->json(array(
            'valid' => is_null($check_user),
        ));
    }
}
