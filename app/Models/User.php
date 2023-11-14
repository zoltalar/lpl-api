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
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
    
    protected $appends = ['password_set'];

    // --------------------------------------------------
    // Accessors and Mutators
    // --------------------------------------------------
    
    public function getPasswordSetAttribute($value): int
    {
        $isset = $this->attributes['password'] !== null;
        
        return $isset ? 1 : 0;
    }
    
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
