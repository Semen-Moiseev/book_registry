<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    // Связь: один жанр -> много книг
    public function books(): BelongsToMany {
        return $this->belongsToMany(Book::class);
    }
}
