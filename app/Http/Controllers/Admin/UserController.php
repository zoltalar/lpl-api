<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Resources\BaseResource;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    {
        $users = QueryBuilder::for(User::class)->paginate();
        
        return BaseResource::collection($users);
    }
    
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
