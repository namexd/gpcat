<?php


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array']
], function ($api) {
    // 版本
    $api->get('version', function () {
        return '1.0.19.4.25';
    });
    $api->resource('goods',GoodsController::class);
    $api->get('suppliers','GoodsController@suppliers');
    $api->get('brands','GoodsController@brands');
    $api->post('upload/upload_file','UploadController@uploadFile');
    $api->post('progress/{queue}','ProgressController@progress');

});