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

    static public function revisions_for_name($nameId)
    {
        return User::select('id', 'name', 'color')->with(
            ['revisions' => 
                function($q) use($nameId) {
                    $q->select('id', 'name_id', 'user_id', 'revision_title', 'created_at')
                        ->where('revision_title', '!=', 'New')
                        ->whereNameId($nameId)
                        ->orderBy('id', 'desc');
                }
            ]
        )->get();
    }
}
