<?php

namespace App\Imports;

use App\Models\Good;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsImport implements ToCollection
{
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
                Good::updateOrCreate($array,$array);
            }

        }

    }
}
