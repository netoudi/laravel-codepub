<?php

namespace CodePub\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use FormAccessible;

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'price',
    ];

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->all();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
