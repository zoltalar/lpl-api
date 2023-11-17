<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Base
{
    use HasFactory;
    
    protected $fillable = [
        'subject',
        'from_field',
        'to_field',
        'reply_to',
        'message',
        'text_message',
        'footer',
        'embargo'
    ];
}
