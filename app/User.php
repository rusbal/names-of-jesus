<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function revisions()
    {
        return $this->hasMany('App\Revision');
    }

    public function latestRevisions($limit = 6)
    {
        return $this->hasMany(Revision::class)->limit($limit)->orderBy('id', 'desc');
    }

    /**
     * Static
     */
    static public function latestRevisionOnName($userId, $nameId)
    {
        return User::find($userId)->latestRevisions(1)->whereNameId($nameId)->first();
    }

    static public function colors()
    {
        return User::pluck('color', 'id')->toArray();
    }
}
