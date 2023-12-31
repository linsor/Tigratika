<?php

namespace App\Http\Controllers\XmlToExcelControllers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class AdminIndexOffersController extends Controller
{
    public function __invoke() 
    {
        $offers = Offer::paginate(20);
        return view('export.offers', compact('offers'));
    }
}
