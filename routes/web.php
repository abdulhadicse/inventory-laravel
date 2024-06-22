<?php

use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Route::get(
    '/dashboard',
    function () {
        return view('admin.layouts.master');
    }
)->middleware(array('auth', 'verified'))->name('dashboard');

// Profile Routes.
Route::middleware('auth')->group(
    function () {
        Route::get('/profile', array(ProfileController::class, 'edit'))->name('profile.edit');
        Route::patch('/profile', array(ProfileController::class, 'update'))->name('profile.update');
        Route::delete('/profile', array(ProfileController::class, 'destroy'))->name('profile.destroy');
    }
);

// Supplier Routes.
Route::resource(
    'supplier',
    SupplierController::class,
    array(
        'names' => array(
            'index' => 'supplier.list',
            'show' => 'supplier.view',
            'create' => 'supplier.add',
            'edit' => 'supplier.edit',
            'update' => 'supplier.update',
            'store' => 'supplier.save',
            'destroy' => 'supplier.delete',
        ),
    )
)->middleware('auth');

// Unit Routes.
Route::resource(
    'unit',
    UnitController::class,
    array(
        'names' => array(
            'index' => 'unit.list',
            'show' => 'unit.view',
            'create' => 'unit.add',
            'edit' => 'unit.edit',
            'update' => 'unit.update',
            'store' => 'unit.save',
            'destroy' => 'unit.delete',
        ),
    )
)->middleware('auth');

// Customer Routes.
Route::resource(
    'customer',
    CustomerController::class,
    array(
        'names' => array(
            'index' => 'customer.list',
            'show' => 'customer.view',
            'create' => 'customer.add',
            'edit' => 'customer.edit',
            'update' => 'customer.update',
            'store' => 'customer.save',
            'destroy' => 'customer.delete',
        ),
    )
)->middleware('auth');

// Category Routes.
Route::resource(
    'category',
    CategoryController::class,
    array(
        'names' => array(
            'index' => 'category.list',
            'show' => 'category.view',
            'create' => 'category.add',
            'edit' => 'category.edit',
            'update' => 'category.update',
            'store' => 'category.save',
            'destroy' => 'category.delete',
        ),
    )
)->middleware('auth');

// Product Routes.
Route::get('/product/stock', array(ProductController::class, 'stock'))->name('product.stock');
Route::resource(
    'product',
    ProductController::class,
    array(
        'names' => array(
            'index' => 'product.list',
            'show' => 'product.view',
            'create' => 'product.add',
            'edit' => 'product.edit',
            'update' => 'product.update',
            'store' => 'product.save',
            'destroy' => 'product.delete',
        ),
    )
)->middleware('auth');

Route::get('/purchase/category', array(PurchaseController::class, 'category'))->name('purchase.category');
Route::get('/purchase/product', array(PurchaseController::class, 'product'))->name('purchase.product');
Route::get('/purchase/pending', array(PurchaseController::class, 'pending'))->name('purchase.pending');

// Product Routes.
Route::resource(
    'purchase',
    PurchaseController::class,
    array(
        'names' => array(
            'index' => 'purchase.list',
            'show' => 'purchase.view',
            'create' => 'purchase.add',
            'edit' => 'purchase.edit',
            'update' => 'purchase.update',
            'store' => 'purchase.save',
            'destroy' => 'purchase.delete',
        ),
    )
)->middleware('auth');


Route::controller(InvoiceController::class)->middleware('auth')->name('invoice.')->group(
    function () {
        Route::get('/invoice/list', 'index')->name('list');
        Route::get('/invoice/create', 'create')->name('add');
        Route::post('/invoice/store', 'store')->name('save');
        Route::get('/invoice/{id}/view', 'show')->name('show');
        Route::post('/invoice/{id}', 'approvalStore')->name('store');
        Route::get('/invoice/approval', 'approvalInvoices')->name('approval');
        Route::get('/invoice/pending', 'pendingInvoices')->name('pending');
        Route::delete('/invoice/{id}/delete/', 'destroy')->name('delete');

        Route::get('/invoice/{id}/print/', 'printInvoice')->name('print');
    }
);

require __DIR__ . '/auth.php';
