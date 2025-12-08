<?php

declare(strict_types= 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * pivot agency_book
 *
 * @property int $id
 * @property int $agency_id
 * @property int $book_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class AgencyBook extends Pivot
{
    protected $table = 'agency_book';

    protected $fillable = [
        'agency_id',
        'book_id',
    ];

    protected $casts = [
        'agency_id'  => 'integer',
        'book_id'    => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
