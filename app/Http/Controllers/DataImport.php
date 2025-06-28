<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DataImportClass;
use Maatwebsite\Excel\Facades\Excel;

class DataImport extends Controller
{
    public function import(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new DataImportClass, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}
