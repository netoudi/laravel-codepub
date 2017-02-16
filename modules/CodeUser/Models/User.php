<?php

namespace Modules\CodeUser\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Modules\CodeBook\Models\Book;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, FormAccessible;

    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getNameTrashedAttribute()
    {
        return $this->trashed() ? "{$this->name} (Inativo)" : $this->name;
    }

    public function formRolesAttribute()
    {
        return $this->roles->pluck('id')->all();
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param Collection|string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return (boolean) $this->roles->contains('name', $role);
        }

        return (boolean) $role->intersect($this->roles)->count();
    }

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->hasRole(config('codeuser.acl.role_admin'));
    }
}
