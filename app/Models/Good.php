<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable=[
        'brand',
        'image',
        'type',
        'model' ,
        'number' ,
        'unit' ,
        'product_area',
        'price' ,
        'price_a',
        'price_b' ,
        'Package' ,
        'supplier' ,
        'repository' ,
        'oil' ,
        'size' ,
        'inner_diameter' ,
        'out_diameter',
        'width' ,
        'weight' ,
        'days' ,
        'comment',
        'extra1',
        'extra2',
        'arranged_time',
    ];

    public function getFilters($column)
    {
        return $this->groupBy($column)->pluck($column,$column)->toArray();

    }
}
