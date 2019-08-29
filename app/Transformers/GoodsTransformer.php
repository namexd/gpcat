<?php

namespace App\Transformers;

use App\Models\Good;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class GoodsTransformer extends TransformerAbstract
{
    public function transform(Good $good)
    {
        return [
            'id'=>$good->id,
            'brand'=>$good->brand,
            'image'=>$_SERVER['HTTP_HOST'].Storage::disk('admin')->url($good->image),
            'type'=>$good->type,
            'model' =>$good->model,
            'number'=>$good->number,
            'unit' =>$good->unit,
            'product_area'=>$good->product_area,
            'price'=>$good->price,
            'price_a'=>$good->price_a,
            'price_b'=>$good->price_b,
            'Package'=>$good->Package,
            'supplier'=>$good->supplier,
            'repository' =>$good->repository,
            'oil'=>$good->oil,
            'size' =>$good->size,
            'inner_diameter' =>$good->inner_diameter,
            'out_diameter'=>$good->out_diameter,
            'width' =>$good->width,
            'weight' =>$good->weight,
            'days'=>$good->daysdays,
            'comment'=>$good->comment,
            'created_at' => $good->created_at->toDateTimeString(),
            'updated_at' => $good->updated_at->toDateTimeString(),
        ];
    }
}