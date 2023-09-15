<?php

namespace App\Models;

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
    // Other
    // --------------------------------------------------
    
    public function uniqueId(): string
    {
        return bin2hex(random_bytes(16));
    }
}
