<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $guarded = ['id'];

    public function parent_name()
    {
        return $this->belongsTo('App\Name');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
