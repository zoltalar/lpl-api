<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class _List extends Base
{
    use HasFactory;
    
    protected $table = 'lists';
    
    protected $fillable = [
        'name',
        'description',
        'list_order',
        'active',
        'category_id'
    ];
    
    protected $casts = [
        'list_order' => 'integer',
        'active' => 'integer'
    ];

    // --------------------------------------------------
    // Relations
    // --------------------------------------------------
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lists_users');
    }
}
