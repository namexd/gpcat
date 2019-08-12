<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiDataDetail extends Model
{
    protected $fillable = ['api_id', 'data'];
    protected $guarded = [];

    public function api()
    {
        return $this->belongsTo(ApiData::class, 'api_id', 'id');
    }

    public function getDataAttribute($value)
    {
        return json_decode($value,true);
    }
    public function setDataAttribute($value)
    {
        $this->attributes['data']= json_encode($value,JSON_UNESCAPED_UNICODE);
    }
}
