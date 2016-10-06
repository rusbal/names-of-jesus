<?php

namespace App;

class ViewHelper
{
    public function latestActivity($revision)
    {
        $action = ($revision->created_at == $revision->updated_at ? 'created' : 'updated');

        return "{$revision->updated_at->format('d.M hA')} $action by {$this->coloredAuthorName($revision)}";
    }

    public function revisionCount($nameId, $userIds)
    {
        return Revision::whereNameId($nameId)->whereIn('user_id', $userIds)->withCount('user')->get();
    }

    public function coloredStatus($status)
    {
        if ($status == 'Not started') {
            return '<span class="label label-danger">' . $status . '</span>';

        } else if ($status == 'Started') {
            return '<span class="label label-default">' . $status . '</span>';

        } else if ($status == 'In progress') {
            return '<span class="label label-info">' . $status . '</span>';

        } else if ($status == 'For review') {
            return '<span class="label label-primary">' . $status . '</span>';

        } else if ($status == 'Reviewed') {
            return '<span class="label label-success">' . $status . '</span>';
        }
    }

    /**
     * Private
     */
    private function coloredAuthorName($revision)
    {
        $user = $revision->user;

        return "<span style='color:{$user->color}'> {$user->name} </span>";
    }
}

