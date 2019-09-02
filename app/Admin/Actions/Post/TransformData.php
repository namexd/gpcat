<?php

namespace App\Admin\Actions\Post;

use App\Models\ApiData;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;

class TransformData extends RowAction
{
    public $name = '同步到数据库';

    public function handle(ApiData $apiData)
    {
        dispatch(new \App\Jobs\TransformData($apiData))->onQueue('transform_data');
        return $this->response()->success('开始同步..')->redirect('/admin/queue/transform_data');
    }

}