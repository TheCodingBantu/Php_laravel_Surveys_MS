<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisitController;

use Illuminate\Support\Facades\Route;
// Route::get('/', function () {return view('landing');});
Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('customer/feedback', [FeedbackController::class, 'form'])->name('feedback-page');
Route::post('customer/feedback', [FeedbackController::class, 'save'])->name('feedback-post');
Route::post('/search', [ProductController::class, 'search'])->name('search');
Route::post('/filter', [ProductController::class, 'filter'])->name('filter');
    //client UI
Route::get('/product-details/{id}', [ProductController::class, 'productDetails'])->name('product-details');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/branch/dashboard', [DashboardController::class, 'branchDashboard'])->name('branchDashboard');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/add-customer', [CustomerController::class, 'show'])->name('addCustomer');
    Route::post('/add-customer', [CustomerController::class, 'storeCustomer'])->name('storeCustomer');
    Route::get('/customer/{id}', [CustomerController::class, 'getCustomer'])->name('getCustomer');
    Route::post('/customer/update', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
    Route::post('/customer/delete', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer');


    Route::get('/branches', [ BranchController::class, 'index'])->name('branches');
    Route::post('/branch', [BranchController::class, 'store'])->name('add-branch');
    Route::post('/edit-branch', [BranchController::class, 'edit'])->name('edit-branch');
    Route::get('/getBranch{id}', [BranchController::class, 'getBranch'])->name('get-branch');

    Route::get('/visits', [VisitController::class, 'visits'])->name('visits');
    Route::post('/visit', [VisitController::class, 'store'])->name('add-visit');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/getFeedback{id}', [FeedbackController::class, 'getFeedback'])->name('getFeedback');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('store-feedback');


    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/password/{id}', [ProfileController::class, 'updatePass'])->name('profile.password');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/markAsRead', [ProfileController::class, 'markAsRead'])->name('markAsRead');

    // CSV upload
    Route::get('/csv/upload', [CsvController::class, 'index'])->name('csv-preview');
    Route::get('/csv/preview/{id}', [CsvController::class, 'getPreview'])->name('getPreview');
    Route::post('/csv/preview/update/', [CsvController::class, 'updatePreview'])->name('updatePreview');
    Route::post('/csv/preview/delete/', [CsvController::class, 'deletePreview'])->name('deletePreview');
    Route::post('/csv/parse', [CsvController::class, 'parse'])->name('csv-parse');
    Route::post('/csv/process', [CsvController::class,'process'])->name('csv-process');
    Route::get('/export/csv', [CsvController::class, 'exportCSV'])->name('export-csv');


    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/clearCart', [CartController::class, 'clearCart'])->name('clearCart');
    Route::post('/delete/cart{id}', [CartController::class, 'deletecartitem'])->name('deleteCartItem');

    Route::post('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');
    Route::get('/cartcount', [CartController::class, 'getCount'])->name('cartcount');
    Route::post('/addtocart', [CartController::class, 'store'])->name('addtocart');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/createOrder', [CartController::class, 'createOrder'])->name('createOrder');

    Route::get('/client/profile', [ClientProfileController::class, 'edit'])->name('clientprofile.edit');
    Route::patch('/client/profile', [ClientProfileController::class, 'update'])->name('clientprofile.update');
    Route::delete('/client/profile', [ClientProfileController::class, 'destroy'])->name('clientprofile.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/order/tracking/{id}', [OrderController::class, 'tracking'])->name('ordertracking');
    Route::post('/order/search', [OrderController::class, 'ordersearch'])->name('ordersearch');

    Route::get('/order/all', [OrderController::class, 'adminOrdersList'])->name('adminorders');

    Route::get('/my/feedback', [OrderController::class, 'feedbacklist'])->name('feedback-list');


});

require __DIR__ . '/auth.php';
