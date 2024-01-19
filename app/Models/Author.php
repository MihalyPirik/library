<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'country'];

    /**
     * The roles that belong to the Author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'authors_books', 'author_id', 'book_id');
    }
}
