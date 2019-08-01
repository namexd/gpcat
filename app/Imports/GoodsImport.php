<?php

namespace App\Imports;

use App\Models\Good;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class GoodsImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $fillables = (new Good())->getFillable();
        $array = [];
        foreach ($fillables as $key => $v) {
            $array[$v] = $row[$key];
        }
        return new Good($array);
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $fillables = (new Good())->getFillable();
        $array = [];
        foreach ($rows as $k => $row) {
            if ($k > 0) {
                foreach ($fillables as $key => $v) {
                    $array[$v] = $row[$key];
                }
                Good::updateOrCreate($array);
            }

        }

    }
}
