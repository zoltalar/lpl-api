<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Resources\BaseResource;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        
        $users = QueryBuilder::for(User::class)
            ->when($search, function($query) use ($search) {
                return $query->search(['email'], $search);
            })
            ->allowedSorts([
                'users.id',
                'users.email',
                'users.confirmed',
                'users.blacklisted'
            ])
            ->paginate();
        
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
