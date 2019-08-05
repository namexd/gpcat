<?php

namespace App\Admin\Actions\Post;

use App\Models\ApiData;
use Encore\Admin\Actions\RowAction;

class Replicate extends RowAction
{
    public $name = '复制';

    public function handle(ApiData $apiData)
    {
        $apiData->replicate()->save();
        return $this->response()->success('复制成功.')->refresh();
    }

}