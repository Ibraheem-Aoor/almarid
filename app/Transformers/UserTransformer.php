<?php namespace App\Transformers;

use App\Models\User;

class UserTransformer extends ParentTransformer{

    public $key = 'users';

    public function transform(User $user){

        $user = [
            'id' => (int)$user->id,
            'name' => $user->name,
            'email'=> $user->email,
            'created_at'=> $user->created_at,
            'updated_at'=> $user->updated_at,
        ];

        return $user;
    }

}