<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Requests\Admin\ListStoreRequest;
use App\Models\_List;
use Exception;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->get('limit', 10);
        
        $lists = QueryBuilder::for(_List::class)
            ->withCount([
                'users as users_confirmed_unblacklisted_count' => function($query) {
                    $query
                        ->where('blacklisted', '!=', 1)
                        ->where('confirmed', 1);
                },
                'users as users_unconfirmed_unblacklisted_count' => function($query) {
                    $query
                        ->where('blacklisted', '!=', 1)
                        ->where('confirmed', '!=', 1);
                },
                'users as users_blacklisted_count' => function($query) {
                    $query->where('blacklisted', 1);
                }
            ])
            ->when($search, function($query) use ($search) {
                return $query->search(['name', 'description'], $search);
            })
            ->allowedSorts([
                'lists.id',
                'lists.name',
                'lists.active',
                'lists.list_order'
            ])
            ->paginate($limit);
        
        return BaseResource::collection($lists);
    }
    
    public function store(ListStoreRequest $request)
    {
        $list = new _List();
        $list->fill($request->only($list->getFillable()));
        $list->save();
        
        return new BaseResource($list);
    }
    
    public function destroy(_List $list)
    {
        $status = 403;
        
        try {
            if ($list->delete()) {
                $status = 204;
            }
        } catch (Exception $e) {}
        
        return response()->json(null, $status);
    }
}
