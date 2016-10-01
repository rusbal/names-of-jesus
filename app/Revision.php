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

    /**
     * Static
     */
    static public function authorsOnNameId($nameId, $limit = 6)
    {
        $authors = [];

        $authorIds = Revision::select('user_id')->whereNameId($nameId)->pluck('user_id')->unique();

        foreach ($authorIds as $authorId) {
            $authors[] = Revision::with('user')->whereNameId($nameId)->whereUserId($authorId)->orderBy('updated_at', 'desc')->limit($limit)->get();
        }

        return $authors;
    }
}
