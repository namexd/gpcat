<?php

namespace App\Http\Controllers\Api;

use App\Models\Good;
use App\Models\Supplier;
use App\Transformers\GoodsTransformer;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    protected $model;

    public function __construct(Good $good)
    {
        $this->model = $good;
    }

    public function index(Request $request)
    {
        $builder = $this->model->query();
        // 判断是否有提交 search 参数，如果有就赋值给 $search 变量
        // search 参数用来模糊搜索商品
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            $builder->where('brand', 'like', $like)
                ->orWhere('type', 'like', $like)
                ->orWhere('model', 'like', $like)
                ->orWhere('supplier', 'like', $like);
        }
        if ($brand = $request->input('brand', '')) {
            $builder->where('brand', $brand);
        }
        if ($repository = $request->input('supplier', '')) {
            $builder->where('supplier', $repository);
        }
        // 是否有提交 order 参数，如果有就赋值给 $order 变量
        // order 参数用来控制商品的排序规则
        if ($order = $request->input('order', '')) {
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 2 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['price', 'number'])) {
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }
        $products = $builder->paginate($request->input('pagesize') ?? 20);
        return $this->response->paginator($products, new GoodsTransformer());

    }

//临时接口
    public function suppliers()
    {
        return $this->response->array((new Supplier())->getList());
    }

    //临时接口
    public function brands()
    {
        return $this->response->array(Good::query()->whereNotNull('brand')->groupBy('brand')->pluck('brand'));
    }
}