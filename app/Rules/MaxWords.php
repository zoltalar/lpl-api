<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Str;

class MaxWords implements ValidationRule
{
    private int $max = 0;
    
    public function __construct(int $max) 
    {
        $this->max = $max;
    }
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Str::of($value)->wordCount() > $this->max) {
            $fail(sprintf('The :attribute cannot exceed %d words', $this->max));
        }
    }
}
