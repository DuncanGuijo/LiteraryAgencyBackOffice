<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string|null $document_path
 * @property int|null $book_id
 * @property int|null $author_id
 * @property int|null $agency_id
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Contract extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'document_path',
        'book_id',
        'author_id',
        'agency_id',
        'is_active',
    ];

    protected $casts = [
        'title'         => 'string',
        'document_path' => 'string',
        'book_id'       => 'integer',
        'author_id'     => 'integer',
        'agency_id'     => 'integer',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
