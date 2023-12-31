<?php

namespace App\Exports;

use App\Models\Offer;
use Maatwebsite\Excel\Concerns\FromCollection;

class MySQLExportExcerl implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Offer::all();
    }
}
