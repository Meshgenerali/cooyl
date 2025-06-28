<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataImport extends Model
{
    protected $fillable = [
        'county_code', 'county_name', 'constituency_code', 'constituency_name',
        'ward_code', 'ward_name', 'centre_code', 'centre_name',
        'polling_station_code', 'polling_station_name', 'registered_voters'
    ];
}
