<?php
/**
 * Plain Object: ViewHelper
 */

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

    public function statusToBootstrap($status, $prefix = '')
    {
        $array = array(
            'Not started' => 'default',
            'Started'     => 'warning',
            'In progress' => 'info',
            'For review'  => 'success',
            'Reviewed'    => 'primary',
        );
        return $prefix . $array[$status];
    }

    public function coloredStatusClass($status, $prefix = 'btn-')
    {
        return $this->statusToBootstrap($status, $prefix);
    }

    public function coloredStatus($status)
    {
        return '<span class="label label-' . $this->statusToBootstrap($status) . '">' . $status . '</span>';
    }

    public function statusButtonSelection($currentStatus, $class)
    {
        return '
            <div id="' . $class . '" class="btn-group">
                <button type="button" class="btn '. $this->coloredStatusClass($currentStatus) .' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status: <b>' . $currentStatus . '</b> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    ' . $this->statusLiSelection( Name::getEnumValuesExcept('status', $currentStatus), $class) . '
                </ul>
            </div>
        ';
    }

    public function statusLiSelection($statuses, $class)
    {
        $html = '';
        foreach ($statuses as $status) {
            $html .= '
                <li><a href="#" onclick="return false" class="' . $class . '">' . $status . '</a></li>';
        }
        return $html;
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

