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

    public function coloredStatusClass($status, $prefix = 'btn-')
    {
        if ($status == 'Not started') {
            return 'btn-danger';

        } else if ($status == 'Started') {
            return 'btn-info';

        } else if ($status == 'In progress') {
            return 'btn-success';

        } else if ($status == 'For review') {
            return 'btn-primary';

        } else if ($status == 'Reviewed') {
            return 'btn-default';
        }
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

    public function statusButtonSelection($currentStatus)
    {
        $statuses = Name::getEnumValues('status');

        if (($key = array_search($currentStatus, $statuses)) !== false) {
            unset($statuses[$key]);
        }

        $otherStatus = '';
        foreach ($statuses as $status) {
            $otherStatus .= '<li><a href="#" onclick="return false" class="submit-new-revision">' . $status . '</a></li>';
        }

        return '<div class="btn-group">
                    <button type="button" class="btn '. $this->coloredStatusClass('In progress') .' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status: <b>' . $currentStatus . '</b> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">' . $otherStatus . '</ul>
                </div>';
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

