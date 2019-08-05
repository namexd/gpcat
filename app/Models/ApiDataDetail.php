<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiDataDetail extends Model
{

    public function api()
    {
        return $this->belongsTo(ApiData::class,'api_id','id');
    }
}
