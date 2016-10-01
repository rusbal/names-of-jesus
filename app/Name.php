<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $guarded = ['id'];

    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }

    public function latestRevision()
    {
        return $this->hasOne(Revision::class)->orderBy('updated_at', 'desc');
    }

    public function createRevision($data)
    {
        $data['user_id'] = \Auth::user()->id;

        return $this->revisions()->create($data);
    }

    /**
     * Static
     */
    static public function createAndInitRevision($name = null)
    {
        if (!$name) {
            return;
        }

        parent::create([])->init_revision($name);
    }

    /**
     * Private
     */
    private function init_revision($name)
    {
        $data = array(
            'revision_title'   => 'First Draft',
            'name'             => $name,
            'verse'            => '',
            'meaning_function' => '',
            'identical_titles' => '',
            'significance'     => '',
            'responsibility'   => '',
            'user_id'          => \Auth::user()->id,
        );
        return $this->revisions()->create($data);
    }
}
