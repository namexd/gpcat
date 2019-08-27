<?php

namespace App\Imports;

use App\Models\Good;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class GoodsImport implements ToModel,WithBatchInserts,WithChunkReading,ShouldQueue
{
    use Importable;
    public function model(array $row)
    {
        $array = [];

        $fillables = (new Good())->getFillable();
        foreach ($fillables as $key => $v) {
            $array[$v] = $row[$key];
        }
        return new Good($array);
    }
    public function batchSize(): int
    {
        return 1000000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
