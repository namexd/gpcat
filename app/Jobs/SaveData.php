<?php

namespace App\Jobs;

use App\Models\ApiData;
use App\Models\ApiDataDetail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SaveData implements ShouldQueue
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
        $results=Cache::get('api_data'.$this->apiData->id);
        if ($results)
        {
            $k=0;
            $this->apiData->detail()->delete();
            foreach ($results as $v)
            {
                ApiDataDetail::query()->create(['api_id'=>$this->apiData->id,'data'=>$v]);
                $k++;
            }
            $this->apiData->count=$k;
            $this->apiData->refresh_time=Carbon::now()->toDateTimeString();
            $this->apiData->save();

        }
    }
}
