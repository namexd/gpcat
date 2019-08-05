<?php

namespace App\Admin\Actions\Post;

use App\Models\ApiData;
use Encore\Admin\Actions\RowAction;

class SyncData extends RowAction
{
    public $name = '同步数据';

    public function handle(ApiData $apiData)
    {
        dispatch(new \App\Jobs\SyncData($apiData));
        return $this->response()->success('已加入同步队列,请稍后查看')->refresh();
    }


}