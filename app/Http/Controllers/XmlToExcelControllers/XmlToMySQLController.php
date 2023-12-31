<?php

namespace App\Http\Controllers\XmlToExcelControllers;

use App\Exports\TigratikaExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use SimpleXMLElement;
use Maatwebsite\Excel\Facades\Excel;



class XmlToMySQLController extends Controller
{
    public function __invoke(Request $request)
    {

        $xmlString = file_get_contents('https://quarta-hunt.ru/bitrix/catalog_export/export_Ngq.xml');
        $xml = new SimpleXMLElement($xmlString);

       // dd($xml->shop->offers);
        //$this->fillingCategoryTable($xml->shop->categories);
        //$this->fillingOfferTable($xml->shop->offers);




       $data  = [];

       foreach($xml->shop->offers->offer as $offer){
        $data[] =  [
            'offerId' => (string) $offer['id'],
            'available' => (string) $offer['available'], 
            'url' => (string) $offer->url,
            'price' => (float) $offer->price,
            'oldprice' => (float) $offer->oldprice,
            'currencyId' => (string) $offer->currencyId, 
            'categoryId' => (string) $offer->categoryId,
            'picture' => (string) $offer->picture,
            'name' => (string) $offer->name,
            'vendor' => (string) $offer->vendor
        ];
       }



       $excelFileName = 'data.xlsx';


        return Excel::download(new TigratikaExport($data), $excelFileName);



    }


    private function fillingCategoryTable($categories, $parentID = null)
    {
        if ($categories->count() > 0) {
            foreach ($categories->category as $category) {
                Category::updateOrInsert(
                    [
                        'id' => (int) $category['id'],
                    ],
                    [
                        'name' => (string) $category,
                        'parentID' => $category['parentId'] !== null ? (int) $category['parentId'] : null
                    ]
                );

                $children = $category->children;
                if ($children && $children->count() > 0) {
                    $this->fillingCategoryTable($children, (int) $category['id']);
                }
            }
        }

    }

    private function fillingOfferTable($offers)
    {

        if ($offers->count() > 0) {
            foreach ($offers->offer as $offer) {
                Offer::updateOrCreate(
                    [
                        'offerId' => (string) $offer['id'],
                        'available' => (bool) $offer['available'],
                        'url' => (string) $offer->url,
                        'price' => (float) $offer->price,
                        'oldprice' => (float) $offer->oldprice,
                        'currencyId' => (string) $offer->currencyId,
                        'categoryID' => (int)$offer->categoryId,
                        'picture' => (string) $offer->picture,
                        'name' => (string) $offer->name,
                        'vendor' => (string) $offer->vendor

                    ]
                );
            }
        }

    }



}


//568 категоря для проверки 3-х уровневая