<?php

namespace App\Jobs;

use App\Imports\GoodsImport;
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
use Maatwebsite\Excel\Facades\Excel;

class ImportData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
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
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::import(new GoodsImport(), $this->file);
//
//        $fillables = (new Good())->getFillable();
//
//        $array = [];
//        $rows=$this->data;
//        foreach ($rows as $k => $row) {
//            if ($k > 0) {
//                foreach ($fillables as $key => $v) {
//                    $array[$v] = $row[$key];
//                }
//                Good::updateOrCreate($array, $array);
//            }
//
//        }
    }
}
