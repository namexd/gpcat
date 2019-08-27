<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', function (){
        return redirect('/admin/goods');
    });
    $router->get('/home', 'HomeController@index')->name('admin.home');
    $router->get('/upload','HomeController@upload');
    $router->post('goods/delete', 'GoodsController@delete');
    $router->resource('goods', GoodsController::class);
    $router->resource('brands', BrandsController::class);
    $router->resource('suppliers', SuppliersController::class);
    $router->resource('api_datas', ApiDatasController::class);

});
