<?php

namespace App\Http\Controllers\Api;

use App\Imports\GoodsImport;
use App\Models\Good;
use App\Models\Supplier;
use App\Transformers\GoodsTransformer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function __construct()
    {
    }

    public function uploadFile(Request $request)
    {
        // 设置超时时间为没有限制
        ini_set("max_execution_time", "0");

        $http_type = ((isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

        $file = $request->file('file');
//        Excel::import(new GoodsImport(),$file);
        $allowed_extensions = ["png", "jpg", "gif", "jpeg", "bmp"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return json_encode(['error' => 'You may only upload png, jpg or gif or jpeg or bmp.']);
        }

        $destinationPath = 'storage/uploads/'.date('Ymd').'/'; //public 文件夹下面建 storage/uploads 文件夹
        $extension = $file->getClientOriginalExtension();
        $fileName = md5(microtime(true)).'.'.$extension;
        $file->move($destinationPath, $fileName);

        return $this->response->array(['type' => $extension , 'url' => $http_type.$_SERVER['HTTP_HOST'].'/'.$destinationPath.'/'.$fileName , 'name' => $fileName]);
    }
}