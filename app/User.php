<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    public function isAdmin() {
        return $this->roles()->where('name', 'admin')->exists();
    }

    public static function getUsers(){

        $records = User::all()->toArray();
        return $records;
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users');
   }

    public function subscribe()
    {
        return $this->belongsToMany(Subscribe::class, 'subscribe_user');
   }

    public function massageUser()
    {
        return $this->belongsTo(MassageUser::class);
   }

    public function poll() {

        return $this->hasMany(Poll::class);
    }
}
