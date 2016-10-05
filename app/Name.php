<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $guarded = ['id'];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->get();
    }

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

    static public function updateSort($nameIds)
    {
        $order = Name::whereIn('order', $nameIds)->min('order');
        $order_arr = [];

        DB::beginTransaction();

        foreach ($nameIds as $id) {
            $name = Name::whereId($id)->first();

            if (!$name) {
                DB::rollBack();
                return false;
            }

            $order_arr[] = $order;
            $name->order = $order;
            $name->save();

            $order += 1;
        }

        DB::commit();
        return $order_arr;
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
