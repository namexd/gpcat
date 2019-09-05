<?php


namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;
use Illuminate\Support\Str;

class PostsExporter extends ExcelExporter
{
    protected $fileName = '产品列表.xlsx';

    protected $columns = [
        'brand' => '型号',
        'image' => '图片',
        'type' => '类型',
        'model' => '型号',
        'number' => '库存',
        'unit' => '单位',
        'product_area' => '产地',
        'price' => '对接价格',
        'price_a' => 'A价格',
        'price_b' => 'B价格',
        'package' => '包装',
        'supplier' => '供应商',
        'repository' => '仓库名称',
        'oil' => '油脂',
        'size' => '尺寸规格',
        'inner_diameter' => '轴承内径',
        'out_diameter' => '轴承外径',
        'width' => '轴承宽度',
        'weight' => '轴承重量',
        'days' => '货期',
        'comment' => '备注',
        'arranged_time' => '导入时间',
        'updated_at' => '更新时间',
    ];

}