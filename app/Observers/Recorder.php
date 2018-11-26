<?php

namespace App\Observers;

use App\Models\Record;
use Auth;

// 默认的记录内容所记录的是model的content属性，
// 可在第三个参数传入自定义的记录内容
class Recorder
{
    public function recordDeleted(
        $model,
        string $action,
        string $content = ""
    ) {
        if (! $content) {
            $content = $model->content;
        }

        Record::create([
            'action' => $action,
            'action_user_id' => Auth::id(),
            'author_user_id' => $model->user_id,
            'content' => $content,
        ]);
    }
}
