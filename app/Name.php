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

    public function revision_array()
    {
        return $this->hasMany(Revision::class)->pluck('revision_title', 'id');
    }

    public function save_revision($data)
    {
        $data['user_id'] = \Auth::user()->id;

        return $this->revisions()->create($data);
    }

    /**
     * Static
     */
    static public function create_and_init_revision($name = null)
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
