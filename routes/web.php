<?php
// web.php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;

Route::get('/', fn() => view('welcome'));

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [SaleController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');Route::post('/profile/theme-toggle', [ProfileController::class, 'toggleTheme'])->name('profile.toggleTheme');
    Route::get('/profile/theme', [ProfileController::class, 'getTheme'])->name('profile.getTheme');

    // Resource Routes
    Route::resources([
        'products' => ProductController::class,
        'customers' => CustomerController::class,
        'vehicles' => VehicleController::class,
        'sales'    => SaleController::class,
    ]);

    // Sales Report Routes
    Route::prefix('sales')->name('sales.')->controller(SaleController::class)->group(function () {
        Route::get('/search', 'search')->name('search'); 
        Route::get('/report', 'report')->name('report');
        Route::get('/report/pdf', 'reportPdf')->name('report.pdf');
        Route::get('/report/excel', 'reportExcel')->name('report.excel');
        Route::get('/report/csv', 'reportCsv')->name('report.csv');
        Route::get('/report/print', 'reportPrint')->name('report.print');

        Route::get('/report/summary', 'reportSummary')->name('report.summary');
        Route::get('/report/summary/pdf', 'reportSummaryPdf')->name('report.summary.pdf');
        Route::get('/report/summary/excel', 'reportSummaryExcel')->name('report.summary.excel');
        Route::get('/report/summary/csv', 'reportSummaryCsv')->name('report.summary.csv');
        Route::get('/report/summary/print', 'reportSummaryPrint')->name('report.summary.print');

        // Additional Routes for Sales        
        Route::resource('vehicles', VehicleController::class)->except(['edit', 'update']);
        Route::get('/report/vehicle/{vehicleId}', 'getSalesByVehicle')->name('report.vehicle.filter');
        Route::get('/report/vehicle/{vehicleId}/pdf', 'getSalesByVehiclePdf')->name('report.vehicle.filter.pdf');
        Route::get('/report/vehicle/{vehicleId}/excel', 'getSalesByVehicleExcel')->name('report.vehicle.filter.excel');
        Route::get('/report/vehicle/{vehicleId}/csv', 'getSalesByVehicleCsv')->name('report.vehicle.filter.csv');   
        Route::get('/report/vehicle/{vehicleId}/print', 'getSalesByVehiclePrint')->name('report.vehicle.filter.print');
        Route::get('/report/vehicle/{vehicleId}/export', 'exportByVehicle')->name('report.vehicle.export');
        Route::get('/report/vehicle/{vehicleId}/export/{format}', 'exportByVehicle')->name('report.vehicle.export.format');
        Route::get('/report/vehicle/{vehicleId}/export/{format}/{startDate}/{endDate}', 'exportByVehicle')->name('report.vehicle.export.date');
        Route::get('/report/vehicle/{vehicleId}/export/{format}/{startDate}/{endDate}/{customerId}', 'exportByVehicle')->name('report.vehicle.export.customer');
        Route::get('/report/vehicle/{vehicleId}/filter', 'filterSalesByVehicle')->name('report.vehicle.filter.sales');
        Route::get('/report/vehicle/{vehicleId}/filter/pdf', 'filterSalesByVehiclePdf')->name('report.vehicle.filter.sales.pdf');
        

        Route::get('/report/customer', 'reportCustomer')->name('report.customer');
        Route::get('/report/customer/pdf', 'reportCustomerPdf')->name('report.customer.pdf');
        Route::get('/report/customer/excel', 'reportCustomerExcel')->name('report.customer.excel');
        Route::get('/report/customer/csv', 'reportCustomerCsv')->name('report.customer.csv');
        Route::get('/report/customer/print', 'reportCustomerPrint')->name('report.customer.print');

        Route::get('/report/product', 'reportProduct')->name('report.product');
        Route::get('/report/product/pdf', 'reportProductPdf')->name('report.product.pdf');
        Route::get('/report/product/excel', 'reportProductExcel')->name('report.product.excel');
        Route::get('/report/product/csv', 'reportProductCsv')->name('report.product.csv');
        Route::get('/report/product/print', 'reportProductPrint')->name('report.product.print');

        Route::get('/report/user', 'reportUser')->name('report.user');
        Route::get('/report/user/pdf', 'reportUserPdf')->name('report.user.pdf');
        Route::get('/report/user/excel', 'reportUserExcel')->name('report.user.excel');
        Route::get('/report/user/csv', 'reportUserCsv')->name('report.user.csv');
        Route::get('/report/user/print', 'reportUserPrint')->name('report.user.print');

        // Exporting
        Route::get('/export', 'export')->name('export');
        Route::get('/export/{format}', 'export')->name('export.format');
        Route::get('/export/{format}/{startDate}/{endDate}', 'export')->name('export.date');
        Route::get('/export/{format}/{startDate}/{endDate}/{customerId}', 'export')->name('export.customer');

        // Filtering
        Route::get('/customer/{customerId}', 'getSalesByCustomer')->name('customer');
        Route::get('/vehicle/{vehicleId}', 'getSalesByVehicle')->name('vehicle');
        Route::get('/date-range/{startDate}/{endDate}', 'getSalesByDateRange')->name('date-range');
        Route::get('/product/{productId}', 'getSalesByProduct')->name('product');
        Route::get('/user/{userId}', 'getSalesByUser')->name('user');

        

    });
});

require __DIR__.'/auth.php';
