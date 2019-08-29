<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

class Supplier extends Model
{
    public function paginate()
    {
        $perPage = Request::get('per_page', 10);

        $page = Request::get('page', 1);

        $start = ($page-1)*$perPage;

        $result = Good::query()->selectRaw('supplier,group_concat(distinct repository,"","") as repository_list,group_concat(distinct brand,"","") as brand_list,count(distinct repository) as repository,count(distinct brand) as brand,count(distinct model) as model,sum(number*price) as price,sum(number) as number,max(updated_at) as updated_at')->whereRaw('length(supplier)>0')->groupBy('supplier')->get()->toArray();

        $brands = static::hydrate($result);

        $paginator = new LengthAwarePaginator($brands, count($result), $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }

    public function getList()
    {
        return Good::query()->whereNotNull('supplier')->groupBy('supplier')->pluck('supplier');
    }
}
