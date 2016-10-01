<?php

namespace App;

class ViewHelper
{
    public function lessons($revision)
    {
        $pre = ($revision->created_at == $revision->updated_at ? 'created' : 'updated');

        return "<b>{$revision->updated_at->format('d.M hA')}</b> $pre by {$revision->user->name}";
    }
}

