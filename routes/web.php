<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidentReportController;
use App\Models\IncidentReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyController;
use App\Services\IncidentReport\IncidentReportService;

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

Route::get('/', [adminController::class, 'logIn'])->name('logIn');
Auth::routes();
Route::get('/signIn', [IncidentReportController::class, 'signIn'])->name('signIn');
Route::middleware(['auth'])->group(function () {
    Route::get('/back', [IncidentReportController::class. 'back'])->name('back');

    Route::post('/updateUser/{user}', [adminController::class, 'updateUser'])->name('updateUser');
    Route::post('/newPassword/{user}', [adminController::class, 'newPassword'])->name('newPassword');

    Route::post('/store', [IncidentReportController::class, 'store'])->name('store');
    Route::post('/update/{incident_report}', [IncidentReportController::class, 'update'])->name('update');

    Route::get('/approve/{incident_report}', [IncidentReportController::class, 'approve'])->name('approve');
    Route::post('/reject/{incident_report}', [IncidentReportController::class, 'reject'])->name('reject');

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

    Route::get('/createIncidentReport', [IncidentReportController::class, 'createIncidentReport'])->name('createIncidentReport');
    Route::get('/removedIncidentReport', [IncidentReportController::class, 'removedIncidentReport'])->name('removedIncidentReport');

    Route::get('/remove/{incident_report}', [IncidentReportController::class, 'destroy'])->name('remove');
    Route::get('/restore/{incident_report}', [IncidentReportController::class, 'restore'])->name('restore');
    Route::get('/show/{incident_report}', [IncidentReportController::class, 'show'])->name('show');

    Route::get('/confirmData/{incident_report}', [IncidentReportController::class, 'confirmData'])->name('confirmData');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [IncidentReportController::class, 'index']);

    Route::get('/users', [adminController::class, 'showUsers'])->name('users');

    Route::get('/incidentReport', [IncidentReportController::class, 'create'])->name('create');
    Route::get('/accomplishmentReport', [IncidentReportController::class, 'accomplishmentReport'])->name('accomplishmentReport');
    Route::post('/createAccomplishment', [IncidentReportController::class, 'createAccomplishment'])->name('createAccomplishment');
    Route::get('/removeAccomplishment/{accomplishmentReport}', [IncidentReportController::class, 'removeAccomplishment'])->name('removeAccomplishment');

    Route::get('/teamLeadCreate', [IncidentReportController::class, 'teamLeadCreate'])->name('teamLeadCreate');
    Route::get('/inventory', [IncidentReportController::class, 'inventory'])->name('inventory');

    Route::get('/adminInventory', [IncidentReportController::class, 'adminInventory'])->name('adminInventory');
    Route::get('/viewItemList/{product}', [IncidentReportController::class, 'viewItemList'])->name('viewItemList');
    Route::get('/underMaintenance/{item}', [IncidentReportController::class, 'underMaintenance'])->name('underMaintenance');
    Route::get('/condemn/{item}', [IncidentReportController::class, 'condemn'])->name('condemn');
    Route::get('/repaired/{item}', [IncidentReportController::class, 'repaired'])->name('repaired');

    Route::get('/summaryReport', [IncidentReportController::class, 'report'])->name('report');
    Route::get('/yearlyMonthlyReport', [IncidentReportController::class, 'yearlyMonthlyReport'])->name('yearlyMonthlyReport');
    Route::get('/detailedReport', [IncidentReportController::class, 'detailedReport'])->name('detailedReport');
    Route::get('/downloadApprovedReports', [IncidentReportController::class, 'downloadApprovedReports'])->name('downloadApprovedReports');
    Route::get('/downloadPendingReports', [IncidentReportController::class, 'downloadPendingReports'])->name('downloadPendingReports');
    Route::get('/downloadRejectedReports', [IncidentReportController::class, 'downloadRejectedReports'])->name('downloadRejectedReports');
    Route::get('/downloadApprovedPdf', [IncidentReportController::class, 'downloadApprovedPdf'])->name('downloadApprovedPdf');
    Route::get('/downloadPendingPdf', [IncidentReportController::class, 'downloadPendingPdf'])->name('downloadPendingPdf');
    Route::get('/downloadRejectedPdf', [IncidentReportController::class, 'downloadRejectedPdf'])->name('downloadRejectedPdf');

    Route::post('/downloadItems/{acronym}', [IncidentReportController::class, 'downloadItems'])->name('downloadItems');

    Route::post('/downloadMonthly', [IncidentReportController::class, 'downloadMonthly'])->name('downloadMonthly');
    Route::post('/downloadYearly', [IncidentReportController::class, 'downloadYearly'])->name('downloadYearly');
    Route::get('/downloadReportPdf/{incident_report}', [IncidentReportController::class, 'downloadReportPdf'])->name('downloadReportPdf');

    Route::get('/inventoryRequest', [IncidentReportController::class, 'inventoryRequest'])->name('inventoryRequest');

    Route::get('/account', [adminController::class, 'account'])->name('account');
    Route::get('/editUser/{user}', [adminController::class, 'editUser'])->name('editUser');
    Route::get('/changePassword/{user}', [adminController::class, 'changePassword'])->name('changePassword');
    Route::post('/search', [IncidentReportController::class, 'search'])->name('search');

    Route::post('/searchTeamLead', [IncidentReportController::class, 'searchTeamLead'])->name('searchTeamLead');

    Route::post('/searchDetailed', [IncidentReportController::class, 'searchDetailed'])->name('searchDetailed');

    Route::post('/searchInventory', [adminController::class, 'searchInventory'])->name('searchInventory');
    
    Route::get('/executivesMaintenance', [adminController::class, 'executivesMaintenance'])->name('executivesMaintenance');
    Route::get('/editExecutive/{executive}', [adminController::class, 'editExecutive'])->name('editExecutive');
    Route::post('/updateExecutive/{executive}', [adminController::class, 'updateExecutive'])->name('updateExecutive');
    Route::get('/logoMaintenance', [adminController::class, 'logoMaintenance'])->name('logoMaintenance');
    Route::get('/logInMaintenance', [adminController::class, 'logInMaintenance'])->name('logInMaintenance');
    Route::post('/uploadLogo/{logo_id}', [adminController::class, 'uploadLogo'])->name('uploadLogo');
    Route::post('/uploadLogIn/{logIn_id}', [adminController::class, 'uploadLogIn'])->name('uploadLogIn');
});