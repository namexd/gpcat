<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class DownloadTemplate extends Action
{
    protected $selector = '.download-template';

    public function handle(Request $request)
    {
        // $request ...

        return $this->response()->redirect('http://gpcat.namexd.cn/download/test.xlsx');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-default download-template" href="/download/test.xlsx" target="_blank" >下载模板</a>
HTML;
    }
}