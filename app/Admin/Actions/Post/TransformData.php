<?php

namespace App\Admin\Actions\Post;

use App\Models\ApiData;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;

class TransformData extends RowAction
{
    public $name = '本地入库';

    public function handle(ApiData $apiData)
    {
        dispatch(new \App\Jobs\TransformData($apiData));
        return $this->response()->success('已加入队列,请稍后查看')->refresh();
    }


}