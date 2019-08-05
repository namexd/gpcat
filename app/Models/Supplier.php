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

        $result = Good::query()->selectRaw('supplier,count(distinct repository) as repository,count(distinct brand) as brand,count(distinct model) as model,sum(price) as price,sum(number) as number,max(updated_at) as updated_at')->groupBy('supplier')->get()->toArray();

        $brands = static::hydrate($result);

        $paginator = new LengthAwarePaginator($brands, count($result), $perPage);

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public static function with($relations)
    {
        return new static;
    }
}
