<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pos\SupplierController;

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
		return view( 'welcome' );
	}
);

Route::get(
	'/dashboard',
	function () {
		return view( 'admin.layouts.master' );
	}
)->middleware( array( 'auth', 'verified' ) )->name( 'dashboard' );

// Profile Routes.
Route::middleware( 'auth' )->group(
	function () {
		Route::get( '/profile', array( ProfileController::class, 'edit' ) )->name( 'profile.edit' );
		Route::patch( '/profile', array( ProfileController::class, 'update' ) )->name( 'profile.update' );
		Route::delete( '/profile', array( ProfileController::class, 'destroy' ) )->name( 'profile.destroy' );
	}
);

// Supplier Routes.
Route::resource(
	'supplier',
	SupplierController::class,
	array(
		'names' => array(
			'index'   => 'supplier.list',
			'show'    => 'supplier.view',
			'create'  => 'supplier.add',
			'edit'    => 'supplier.edit',
			'update'  => 'supplier.update',
			'store'   => 'supplier.save',
			'destroy' => 'supplier.delete',
		),
	)
)->middleware( 'auth' );


// Route::middleware( 'auth' )->group(
// function () {
// Route::get( '/supplier/all', array( SupplierController::class, 'all' ) )->name( 'supplier.all' );
// Route::get( '/supplier/add', array( SupplierController::class, 'add' ) )->name( 'supplier.add' );
// }
// );

// Route::controller( SupplierController::class )->middleware( 'auth' )->name( 'supplier.' )->group(
// function () {
// Route::get( '/supplier/all', 'all' )->name( 'all' );
// Route::get( '/supplier/add', 'add' )->name( 'add' );
// }
// );

require __DIR__ . '/auth.php';
