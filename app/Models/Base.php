<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{
    public const DEFAULT_STRING_LENGTH = 255;
    
    // --------------------------------------------------
    // Scopes
    // --------------------------------------------------
    
    public function scopeSearch(Builder $query, array $columns, string $phrase = null, array $callbacks = []): Builder
    {
        if (empty($phrase)) {
            $phrase = request()->get('search');
        }

        $phrase = (string) $phrase;

        if (is_numeric($phrase) || filter_var($phrase, FILTER_VALIDATE_EMAIL)) {
            $words = [$phrase];
        } else {
            $words = str_word_count($phrase, 1);
        }

        foreach ($words as $word) {
            $word = trim($word);

            foreach ($callbacks as $callback) {
                if (function_exists($callback)) {
                    $word = call_user_func($callback, $word);
                }
            }

            $operator = 'like';

            if (is_numeric($word)) {
                $operator = '=';
            } else {
                $word = "%$word%";
            }

            $query->where(function ($builder) use ($columns, $operator, $word) {
                foreach ($columns as $column) {
                    $builder->orWhere($column, $operator, $word);
                }
            });
        }

        return $query;
    }
}
