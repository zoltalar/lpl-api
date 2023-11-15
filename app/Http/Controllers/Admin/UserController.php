<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Resources\BaseResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->get('limit', 10);
        
        $users = QueryBuilder::for(User::class)
            ->with(['lists'])
            ->when($search, function($query) use ($search) {
                return $query->search(['email'], $search);
            })
            ->allowedSorts([
                'users.id',
                'users.email',
                'users.confirmed',
                'users.blacklisted'
            ])
            ->paginate($limit);
        
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
    
    public function destroy(User $user)
    {
        $status = 403;
        
        try {
            if ($user->delete()) {
                $status = 204;
            }
        } catch (Exception $e) {}
        
        return response()->json(null, $status);
    }
}
