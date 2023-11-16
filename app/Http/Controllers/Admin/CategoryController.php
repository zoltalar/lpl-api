<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->get('limit', 10);
        $all = $request->all;
        
        $categories = QueryBuilder::for(Category::class)
            ->when($search, function($query) use ($search) {
                return $query->search(['name'], $search);
            })
            ->allowedSorts([
                'categories.id',
                'categories.name'
            ]);
            
        $categories = ($all ? $categories->get() : $categories->paginate($limit));
        
        return BaseResource::collection($categories);
    }
    
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();
        $category->fill($request->only($category->getFillable()));
        $category->save();
        
        return new BaseResource($category);
    }
}
