<?php

namespace Modules\CodeBook\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CodeUser\Models\User;

class Book extends Model
{
    use FormAccessible, SoftDeletes, BookStorageTrait, BookThumbnailTrait;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'price',
        'dedication',
        'description',
        'website',
        'percent_complete',
        'published',
    ];

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->all();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTrashed();
    }
}
