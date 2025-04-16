<?php

namespace App\Models;

use App\Enums\BookType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author_id', 'type'];

    // Указываем, что 'type' — это Enum
    protected $casts = [
        'type' => BookType::class,
    ];

    // Связь: одна книга -> один автор
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    // Связь: одна книга -> много жанров
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
