<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Base
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    public $timestamps = false;

    // --------------------------------------------------
    // Relations
    // --------------------------------------------------
    
    protected function lists(): HasMany
    {
        return $this->hasMany(_List::class);
    }
}
