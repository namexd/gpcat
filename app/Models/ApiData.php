<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiData extends Model
{
    public function getTranslateAttribute($translate)
    {
        return array_values(json_decode($translate, true) ?: []);
    }

    public function setTranslateAttribute($translate)
    {
        $this->attributes['translate'] = json_encode(array_values($translate));
    }
    public function getDataParamsAttribute($translate)
    {
        return array_values(json_decode($translate, true) ?: []);
    }

    public function setDataParamsAttribute($translate)
    {
        $this->attributes['data_params'] = json_encode(array_values($translate));
    }
    public function getAuthParamsAttribute($translate)
    {
        return array_values(json_decode($translate, true) ?: []);
    }

    public function setAuthParamsAttribute($translate)
    {
        $this->attributes['auth_params'] = json_encode(array_values($translate));
    }
}
