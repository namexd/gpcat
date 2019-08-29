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
use Illuminate\Support\Facades\Log;

class SyncData implements ShouldQueue
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
     *
     * @param ApiData $apiData
     */
    public function __construct(ApiData $apiData)
    {
        $this->apiData = $apiData;
    }

    /**
     * Execute the job.
     *
     * @param ApiData $apiData
     * @return void
     */
    public function handle()
    {
        $token = $this->getToken($this->apiData);
        Log::info('请求开始：'.Carbon::now()->toDateTimeString());
        $params = [];
        if ($this->apiData->data_params) {
            foreach ($this->apiData->data_params as $data_param) {
                $params += [
                    $data_param['key'] => $data_param['value']
                ];
            }
        }
        if ($this->apiData->id==2)
        {
            $result=$this->curl_https($this->apiData->data_url,json_encode($params),array('Content-Type:application/json'));
            $result = trim($result,chr(239).chr(187).chr(191));
            $results =  array_get(json_decode($result,true),$this->apiData->response_param);
        }else
        {
            $client = new MicroserviceAPI(['token' => $token], $this->apiData->data_url);
            $result = $client->action($this->apiData->method, '', $params);
            $result=trim($result,chr(239).chr(187).chr(191));
            $results =  array_get(json_decode($result,true),$this->apiData->response_param);
        }
        Cache::put('api_data'.$this->apiData->id,$results,Carbon::now()->addMinutes(10));
        dispatch((new SaveData($this->apiData))->onQueue('sync_data'));
    }

    public function getToken(ApiData $apiData)
    {
        if ($token = Cache::get('tokenfromid'.$apiData->id)) {
            return $token;
        } else {
            $params = [];
            if ($apiData->auth_params) {
                foreach ($apiData->auth_params as $auth_param) {
                    $params += [
                        $auth_param['key'] => $auth_param['value']
                    ];
                }
                $client = new MicroserviceAPI([], $apiData->auth_url);
                $result = $client->action('POST', '', $params);
                $result = json_decode($result, true);
                Cache::put('tokenfromid'.$apiData->id, $result['data']['token'], Carbon::now()->addSeconds($result['data']['expire'] / 1000));
                return $result['data']['token'];
            }
           return '';
        }

    }

    function curl_https($url, $data=null, $header=null, $timeout=30){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

        $response = curl_exec($ch);

        if($error=curl_error($ch)){
            die($error);
        }

        curl_close($ch);

        return $response;

    }
}
