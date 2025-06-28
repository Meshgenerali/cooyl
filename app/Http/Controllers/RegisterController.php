<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $counties = DB::table('data_imports')
            ->select('county_name')
            ->distinct()
            ->orderBy('county_name')
            ->get();

        return view('register', compact('counties'));
    }

    public function getConstituencies(Request $request) {
        $county = $request->query('county');

        $constituencies = DB::table('data_imports')
            ->where('county_name', $county)
            ->select('constituency_name')
            ->distinct()
            ->orderBy('constituency_name')
            ->get();

        return response()->json($constituencies);
    }

    public function getWards(Request $request) {
        $constituency = $request->query('constituency');

        $wards = DB::table('data_imports')
            ->where('constituency_name', $constituency)
            ->select('ward_name')
            ->distinct()
            ->orderBy('ward_name')
            ->get();

        return response()->json($wards);
    }

    public function getPollingStations(Request $request) {
        $ward = $request->query('ward');

        $pollingStations = DB::table('data_imports')
            ->where('ward_name', $ward)
            ->select('polling_station_name')
            ->distinct()
            ->orderBy('polling_station_name')
            ->get();

        return response()->json($pollingStations);
    }
}
