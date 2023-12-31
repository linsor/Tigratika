<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TigratikaExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
        use Exportable;

        protected $data;

        public function __construct(array $data)
        {
            
            $this->data = $data;
        }
        public function array(): array
        {
                return $this->data;
        }

        public function headings():array
        {
            return [
            'offerId',
            'available', 
            'url',
            'price',
            'oldprice',
            'currencyId', 
            'categoryId',
            'picture',
            'name',
            'vendor'
            ];
        }
}
