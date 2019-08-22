<?php

namespace App\Admin\Actions\Post;

use App\Imports\GoodsImport;
use App\Jobs\ImportData;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportPost extends Action
{
    public $name = '导入数据';

    protected $selector = '.import-post';

    public function handle(Request $request)
    {
        $file=$request->file('file');
        (new GoodsImport)->queue($file);
        return $this->response()->success('已加入队列，请稍后查看')->refresh();
    }

    public function form()
    {
        $this->file('file', '请选择文件');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default import-post" target="_blank"><i class="fa fa-upload"></i>导入数据</a>
HTML;
    }
}