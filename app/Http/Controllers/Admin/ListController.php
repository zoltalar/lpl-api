<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Models\_List;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->get('limit', 10);
        
        $lists = QueryBuilder::for(_List::class)
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
}
