<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
     protected $fillable = ['name']; // Поля, доступные для массового заполнения

    // Связь: один автор -> много книг
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
