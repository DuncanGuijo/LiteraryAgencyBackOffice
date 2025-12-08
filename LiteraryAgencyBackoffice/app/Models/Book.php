<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int          $id
 * @property string       $title
 * @property string|null  $isbn
 * @property string|null  $description
 * @property int|null     $author_id
 * @property array|null   $agencies_ids
 * @property array|null   $genres
 * @property bool         $is_active
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'isbn',
        'description',
        'author_id',
        'agencies_ids',
        'genres',
        'is_active',
    ];

    protected $casts = [
        'title'         => 'string',
        'description'   => 'string',
        'author_id'     => 'integer',
        'agencies_ids'  => 'array',
        'genres'        => 'array',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function agencies(): BelongsToMany
    {
        return $this->belongsToMany(Agency::class, 'agency_book', 'book_id', 'agency_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function comments()
    {
        return $this->hasMany(BookComment::class);
    }

}
