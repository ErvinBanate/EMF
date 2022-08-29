<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidentReportController;
use App\Models\IncidentReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('logIn');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post('/store', [IncidentReportController::class, 'store'])->name('store');
    Route::post('/update/{incident_report}', [IncidentReportController::class, 'update'])->name('update');
    Route::get('/approve/{incident_report}', [IncidentReportController::class, 'approve'])->name('approve');
    Route::get('/reject/{incident_report}', [IncidentReportController::class, 'reject'])->name('reject');

    Route::post('/createProduct', [adminController::class, 'createProduct'])->name('createProduct');
    Route::post('/addStock', [adminController::class, 'addStock'])->name('addStock');
    Route::post('/removeStock', [adminController::class, 'removeStock'])->name('removeStock');

    Route::post('/createNewProductRequest', [IncidentReportController::class, 'createNewProductRequest'])->name('createNewProductRequest');
    Route::get('/approveRequest/{product_request}', [IncidentReportController::class, 'approveRequest'])->name('approveRequest');
    Route::get('/rejectRequest/{product_request}', [IncidentReportController::class, 'rejectRequest'])->name('rejectRequest');
    Route::get('/removeRequest/{product_request}', [IncidentReportController::class, 'removeRequest'])->name('removeRequest');
    Route::get('/removeProduct/{inventory_product}', [adminController::class, 'removeProduct'])->name('removeProduct');
    Route::get('/adminInventoryRequest', [IncidentReportController::class, 'adminInventoryRequest'])->name('adminInventoryRequest');
    
    Route::get('/edit/{incident_report}', [IncidentReportController::class, 'edit'])->name('edit');
    Route::get('/remove/{incident_report}', [IncidentReportController::class, 'destroy'])->name('remove');
    Route::get('/show/{incident_report}', [IncidentReportController::class, 'show'])->name('show');
    Route::get('/confirmData/{incident_report}', [IncidentReportController::class, 'confirmData'])->name('confirmData');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [IncidentReportController::class, 'index']);
    Route::get('/users', [adminController::class, 'showUsers'])->name('users');
    Route::get('/incidentReport', [IncidentReportController::class, 'create'])->name('create');
    Route::get('/inventory', [IncidentReportController::class, 'inventory'])->name('inventory');
    Route::get('/adminInventory', [IncidentReportController::class, 'adminInventory'])->name('adminInventory');
    Route::get('/report', [IncidentReportController::class, 'report'])->name('report');
    Route::get('/downloadApprovedReports', [IncidentReportController::class, 'downloadApprovedReports'])->name('downloadApprovedReports');
    Route::get('/downloadPendingReports', [IncidentReportController::class, 'downloadPendingReports'])->name('downloadPendingReports');
    Route::get('/downloadRejectedReports', [IncidentReportController::class, 'downloadRejectedReports'])->name('downloadRejectedReports');
    Route::get('/downloadApprovedPdf', [IncidentReportController::class, 'downloadApprovedPdf'])->name('downloadApprovedPdf');
    Route::get('/downloadPendingPdf', [IncidentReportController::class, 'downloadPendingPdf'])->name('downloadPendingPdf');
    Route::get('/downloadRejectedPdf', [IncidentReportController::class, 'downloadRejectedPdf'])->name('downloadRejectedPdf');
    Route::get('/downloadReportPdf/{incident_report}', [IncidentReportController::class, 'downloadReportPdf'])->name('downloadReportPdf');
    Route::get('/inventoryRequest', [IncidentReportController::class, 'inventoryRequest'])->name('inventoryRequest');
});
