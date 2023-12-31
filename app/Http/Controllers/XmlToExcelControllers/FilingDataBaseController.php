<?php

namespace App\Http\Controllers\XmlToExcelControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Offer;
use SimpleXMLElement;

class FilingDataBaseController extends Controller
{
    
    public function __invoke(){

        $xmlString = file_get_contents('https://quarta-hunt.ru/bitrix/catalog_export/export_Ngq.xml');
        $xml = new SimpleXMLElement($xmlString);


        $this->fillingCategoryTable($xml->shop->categories);
        $this->fillingOfferTable($xml->shop->offers);
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
