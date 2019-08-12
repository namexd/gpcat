<?php

namespace App\Admin\Actions\Post;

use App\Models\ApiData;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;

class SyncData extends RowAction
{
    public $name = '更新数据';

    public function handle(ApiData $apiData)
    {
//        if (Carbon::now()->diffInMinutes($apiData->refresh_time)<10)
//        {
//            return $this->response()->error('10分钟内请勿重复请求');
//        }
        $apiData->refresh_time=Carbon::now();
        $apiData->save();
        dispatch(new \App\Jobs\SyncData($apiData));
        return $this->response()->success('已加入同步队列,请稍后查看')->refresh();
    }


}