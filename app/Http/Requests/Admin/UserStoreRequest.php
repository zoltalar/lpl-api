<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\Base;

class UserStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $length = Base::DEFAULT_STRING_LENGTH;        
        $rules = ['email' => ['required', 'email', "max:{$length}", 'unique:users,email']];
        $password = $this->password;
        
        if (! empty($password)) {
            $rules['password'] = ['string', 'min:8'];
        }
        
        return $rules;        
    }
}
