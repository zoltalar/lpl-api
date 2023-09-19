<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Resources\BaseResource;
use App\Models\User;

class UserController extends Controller
{
    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $data = $request->only($user->getFillable());
        
        if (empty($data['password'])) {
            unset($data['password']);
        }
        
        $user->fill($data);
        $user->save();
        
        return new BaseResource($user);
    }
}
