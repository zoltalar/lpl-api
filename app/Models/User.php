<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Base
{
    use HasFactory, 
        Notifiable;
    
    protected $fillable = [
        'email',
        'password',
        'html_email',
        'confirmed',
        'disabled',
        'blacklisted',
        'opted_in',
        'bounce_count',
        'subscribe_page',
        'rss_frequency'
    ];
    
    protected $hidden = ['password'];
    
    protected $casts = [
        'html_email' => 'integer',
        'confirmed' => 'integer',
        'disabled' => 'integer',
        'blacklisted' => 'integer',
        'opted_in' => 'integer',
        'bounce_count' => 'integer',
    ];
    
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
    
    // --------------------------------------------------
    // Relations
    // --------------------------------------------------
    
    public function lists(): BelongsToMany
    {
        return $this->belongsToMany(_List::class);
    }
    
    // --------------------------------------------------
    // Other
    // --------------------------------------------------
    
    public function uniqueId(): string
    {
        return bin2hex(random_bytes(16));
    }
}
