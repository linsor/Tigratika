<?php

namespace App\Http\Controllers\XmlToExcelControllers;

use App\Exports\TigratikaExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\XMLFile;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Http\Request;
use SimpleXMLElement;
use Maatwebsite\Excel\Facades\Excel;



class XmlToExcelController extends Controller
{
    public function __invoke()
    {
        $xmlString = file_get_contents('https://quarta-hunt.ru/bitrix/catalog_export/export_Ngq.xml');
        $xml = new SimpleXMLElement($xmlString);
        $excelFileName = 'data.xlsx';

        foreach ($xml->shop->categories->category as $category) {
            $dataCategories[] = [
                'id' => (int) $category['id'],
                'name' => (string) $category,
                'parentId' => (int) $category['parentId']
            ];
        }

        $data = [];
        $data = $this->fillengArrayData($data, $xml, $dataCategories);

        return Excel::download(new TigratikaExport($data), $excelFileName);
    }

    private function fillengArrayData($data, $xml, $dataCategories): array
    {
        foreach ($xml->shop->offers->offer as $offer) {
            $data[] = [
                'offerId' => (string) $offer['id'],
                'available' => (string) $offer['available'],
                'url' => (string) $offer->url,
                'price' => (float) $offer->price,
                'oldprice' => (float) $offer->oldprice,
                'currencyId' => (string) $offer->currencyId,
                'categoryId' => (string) $this->searchSubCategoryName($offer->categoryId, $dataCategories),
                'sub_categoryId' => $this->searchSubCategoryName(
                    $this->searchSubCategory($offer->categoryId, $dataCategories), $dataCategories
                ),
                'sub_sub_categoryId' => $this->searchSubCategoryName( 
                    $this->searchSubCategory(
                    $this->searchSubCategory($offer->categoryId, $dataCategories),
                    $dataCategories),$dataCategories
                ),
                'picture' => (string) $offer->picture,
                'name' => (string) $offer->name,
                'vendor' => (string) $offer->vendor
            ];
        }
        return $data;
    }
    private function searchSubCategory($categoryId, $dataCategories)
    {
        foreach ($dataCategories as $category) {
            if ($categoryId == $category['id'] & $category['parentId'] != null) {
                return $category['parentId'];

            }
        }
        return null;
    }
    private function searchSubCategoryName($categoryId, $dataCategories)
    {
        foreach ($dataCategories as $category) {
            if ($categoryId == $category['id']) {
                return $category['name'];

            }
        }
        return null;
    }
}
