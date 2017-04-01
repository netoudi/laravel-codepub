<?php

namespace Modules\CodeBook\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = [
        'name',
        'content',
        'order',
        'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
