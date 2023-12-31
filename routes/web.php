<?php

use App\Http\Controllers\XmlToExcelControllers\AdminIndexOffersController;
use App\Http\Controllers\XmlToExcelControllers\ExportDBtoExcelController;
use App\Http\Controllers\XmlToExcelControllers\FilingDataBaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XmlToExcelControllers\XmlToExcelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [XmlToExcelController::class, '__invoke'])->name('XMLtoExcel');

Route::get('/admin', [AdminIndexOffersController::class, '__invoke'])->name('admin.index');
Route::get('/download', [ExportDBtoExcelController::class, '__invoke'])->name('data.download');
Route::get('/filling', [FilingDataBaseController::class, '__invoke'])->name('data.filling');