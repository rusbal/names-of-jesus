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
        # TODO: Use first line when not using faker data which will correctly fetch latest.

        // return $this->hasOne(Revision::class)->latest();
        
        return $this->hasOne(Revision::class)->orderBy('id', 'desc');
    }

    // public function revision_array()
    // {
    //     return $this->hasMany(Revision::class)->pluck('revision_title', 'id');
    // }

    public function createRevision($data)
    {
        $data['user_id'] = \Auth::user()->id;

        return $this->revisions()->create($data);
    }

    // public function updateRevision($data)
    // {
    //     $data['user_id'] = \Auth::user()->id;
    //
    //     return $this->revisions()->create($data);
    // }

    /**
     * Static
     */
    static public function createAndInitRevision($name = null)
    {
        if ($name) {
            $name = parent::create([]);
            $name->init_revision($name);
        }
    }

    /**
     * Private
     */
    private function init_revision($name)
    {
        $data = array(
            'revision_title'   => 'New',
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
