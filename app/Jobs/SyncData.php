<?php

namespace App\Jobs;

use App\Models\ApiData;
use App\Models\ApiDataDetail;
use App\Models\MicroserviceAPI;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;

class SyncData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $apiData;

    /**
     * Create a new job instance.
     *
     * @param ApiData $apiData
     */
    public function __construct(ApiData $apiData)
    {
        $this->apiData=$apiData;
    }

    /**
     * Execute the job.
     *
     * @param ApiData $apiData
     * @return void
     */
    public function handle()
    {
        $token=$this->getToken($this->apiData);
        $client=new MicroserviceAPI(['token'=>$token],$this->apiData->data_url);
        $params=[];
        if ($this->apiData->data_params)
        {
            foreach ($this->apiData->data_params as $data_param)
            {
                $params+=[
                    $data_param['key']=>$data_param['value']
                ];
            }
        }
        $result=$client->action($this->apiData->method,'',$params);
        $this->apiData->detail()->create(['data'=>count(json_decode($result,true)['data'])]);

    }

    public function getToken(ApiData $apiData)
    {
        if ($token=Cache::get('tokenfromid'.$apiData->id))
        {
            return $token;
        }else
        {
            $params=[];
            if ($apiData->auth_params)
            {
                foreach ($apiData->auth_params as $auth_param)
                {
                    $params+=[
                        $auth_param['key']=>$auth_param['value']
                    ];
                }
            }
            $client=new MicroserviceAPI([],$apiData->auth_url);
            $result=$client->action('POST','',$params);
            $result= json_decode($result,true);
            Cache::put('tokenfromid'.$apiData->id,$result['data']['token'],Carbon::now()->addSeconds($result['data']['expire']/1000));
            return $result['data']['token'];
        }

    }
}
