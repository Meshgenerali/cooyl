<?php

namespace App\Imports;

use App\Models\DataImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class DataImportClass implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataImport([
            'county_code' => $row['county_code'],
            'county_name' => $row['county_name'],
            'constituency_code' => $row['constituency_code'],
            'constituency_name' => $row['constituency_name'],
            'ward_code' => $row['ward_code'],
            'ward_name' => $row['ward_name'],
            'centre_code' => $row['centre_code'],
            'centre_name' => $row['centre_name'],
            'polling_station_code' => $row['polling_station_code'],
            'polling_station_name' => $row['polling_station_name'],
            'registered_voters' => $row['registered_voters'],
        ]);
    }

    public function chunkSize(): int
    {
        return 100; // Read 1000 rows at a time
    }

    public function batchSize(): int
    {
        return 100; // Insert 1000 rows per batch
    }
}
