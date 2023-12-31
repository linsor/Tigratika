<?php

namespace App\Http\Controllers\XmlToExcelControllers;

use App\Exports\DBExportExcel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportDBtoExcelController extends Controller
{
    public function __invoke(){

        return Excel::download(new DBExportExcel, 'File.xlsx');
    }
}
