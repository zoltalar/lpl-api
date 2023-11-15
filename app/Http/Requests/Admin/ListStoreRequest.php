<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\Base;

class ListStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $length = Base::DEFAULT_STRING_LENGTH;
        
        return [
            'name' => ['required', "max:{$length}", 'unique:lists,name'],
            'description' => ['nullable', 'max:500'],
            'list_order' => ['nullable', 'numeric']        
        ];    
    }
}
