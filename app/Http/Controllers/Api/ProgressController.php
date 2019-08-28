<?php

namespace App\Http\Controllers\Api;

use App\Models\Good;
use App\Models\Supplier;
use App\Transformers\GoodsTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{

    public function progress($queue)
    {

        $time1=time();
        while (DB::table('jobs')->where('queue',$queue)->get()->isNotEmpty())
        {
            sleep(1);
        }
        $time2=time();
        $back['code'] = 0;
        $back['data'] = [];
        $back['msg'] = '任务完成，共耗时'.($time2-$time1).'秒';
        return $this->response->array($back);
    }
}