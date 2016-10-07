<?php
/**
 * Plain Object: ViewHelper
 */

namespace App;

use Auth;

class ViewHelper
{
    public function initGlobalJsVars($name)
    {
        $array = array(
            'csrfToken' => csrf_token(), 
            'user'      => Auth::user(),
        );

        if (isset($name)) {
            $array['name'] = $name;
        }

        echo "
            window.Laravel = " . json_encode($array) . "
        ";
    }

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

    public function listComments($data, $class, $style = 'warning')
    {
        if (!$data) return;

        $hidden = $class == 'hidden' ? ' style="display:none" ' : '';

        $lis = '';
        foreach ($data as $datum) {
            $lis .= '
                <li class="list-group-item list-group-item-warning" data-id="'. $datum->id .'" ' . $hidden . '>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <span class="label" style="background:' . $datum->user->color . '">' . $datum->user->initials . '</span>
                    <small>'. $datum->comment .'</small>
                </li>';
        }

        $addCommentForm = '
                <li class="list-group-item list-group-item-warning">
                    <span class="label" style="background:' . Auth::user()->color . '">' . Auth::user()->initials . '</span>
                    <button class="btn btn-xs btn-warning pull-right add-comment-btn">Add Comment</button>
                    <textarea class="form-paper-control" id="" name=""></textarea>
                </li>';

        return '
            <ul class="list-group comments" ' . $hidden . '>' . $lis . $addCommentForm . '</ul>';
    }

    public function seeCommentButton($comments, $style = 'default')
    {
        $count = count($comments);

        if ($count > 0) {
            return '
            <button type="button" class="btn btn-' . $style . ' btn-xs see-comment-button">
                <span class="comment-count">' . $count . '</span> Comments
            </button>';
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

