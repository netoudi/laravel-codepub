<?php

namespace CodePub;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
