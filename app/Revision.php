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

    static public function user_revisions($nameId)
    {
        // return $this->with(
        //     [
        //         'revision'      => function($q) {$q->select('id', 'name_id', 'user_id', 'revision_title');}, 
        //         'revision.user' => function($q) {$q->select('id', 'color', 'name');}
        //     ]
        // )->orderBy('id', 'desc')
        //     ->groupBy('revision.user')
        //     ->take(6)
        //     ->get()
        //     ->reverse();

        return Revision::select('revision_title', 'id', 'created_at')
            ->with(['user' => function($q) {$q->select('id', 'color', 'name');}])
            ->whereNameId($nameId)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get()
            ->reverse();
    }
}
