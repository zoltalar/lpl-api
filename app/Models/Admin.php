<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Base
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'phone',
        'password',
        'active'
    ];
    
    protected $hidden = ['password'];
    
    // --------------------------------------------------
    // Accessors and Mutators
    // --------------------------------------------------

    public function setPasswordAttribute($value): void
    {
        if (! empty($value)) {
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }
}
