<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $guarded = ['id'];

    public function revisions()
    {
        return $this->hasMany('App\Revision');
    }

    public function revision()
    {
        return $this->hasOne('App\Revision')->latest();
    }
}
