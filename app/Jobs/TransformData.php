<?php

namespace App\Jobs;

use App\Models\ApiData;
use App\Models\ApiDataDetail;
use App\Models\Good;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TransformData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $apiData;
    public $tries = 5;
    /**
     * 任务可以执行的最大秒数 (超时时间)。
     *
     * @var int
     */
    public $timeout = 120;
    /**
     * Create a new job instance.
     * @param $apiData
     */
    public function __construct(ApiData $apiData)
    {
        $this->apiData=$apiData;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $results=ApiDataDetail::where('api_id',$this->apiData->id)->get()->pluck('data');
        $attribute=[];
        if ($results)
        {
            foreach ($results as $key=> $result)
            {
                foreach ($this->apiData->translate as $item)
                {
                    if (strrpos($item['origin'],'.')!==FALSE)
                    {
                        $ex=explode('.',$item['origin']);
                        $origin=$result[$ex[0]][$ex[1]];
                    }else
                    {
                        $origin=$result[$item['origin']];
                    }
                    $attribute[$item['local']] = $origin;
                    $attribute['supplier']=$this->apiData->name;
                }
             Good::query()->create($attribute);
            }

        }
    }
}
