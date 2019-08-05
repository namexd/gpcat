<?php

namespace App\Admin\Actions\Post;

use App\Models\ApiData;
use Encore\Admin\Actions\RowAction;
use GuzzleHttp\Client;

class SyncData extends RowAction
{
    public $name = '同步数据';

    public function handle(ApiData $apiData)
    {
        // $model ...

        return $this->response()->success('Success message.')->refresh();
    }

    public function getToken()
    {
        $clinet=new Client();
    }

}