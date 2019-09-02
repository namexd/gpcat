<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client as GoutteClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Pool;
use Illuminate\Support\Facades\Storage;
use QL\QueryList;

class Splider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:spider'; //concurrency为并发数  keyWords为查询关键词

    protected $description = 'php spider';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ql = QueryList::post('http://www.thht365.com/Buyweb/PC/Auth/Login',[
            'User' => 'QWERTY',
            'password' => '123456'
        ])->post('http://www.thht365.com/Buyweb/PC/Prdt/GetPrdtList',[
            'IDX_NO'=>'001-01','CurPageNo'=>1
        ]);
        $datas=json_decode($ql->getHtml(),true);
        $totalPageCount=$datas['totalPageCount'];
        for($i=0;$i<$totalPageCount;$i++)
        {
            $ql->post('http://www.thht365.com/Buyweb/PC/Prdt/GetPrdtList',[
            'IDX_NO'=>'001-01','CurPageNo'=>$i
        ]);
        }
    }
}
