<?php

namespace App\Http\Controllers\Pos;

use App\Services\Unit\UnitService;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Services\Category\CategoryService;
use App\Services\Supplier\SupplierService;
use App\Http\Requests\Product\ProductStoreRequest;

class ProductController extends Controller {

	private ProductService $productService;

	/**
	 * Constructor for ProductController.
	 *
	 * @param ProductService $productService The ProductService instance.
	 */
	public function __construct( ProductService $productService ) {
		$this->productService = $productService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\View The view for listing products.
	 */
	public function index() {
		$products = $this->productService->list();
		return view( 'admin.modules.product.index', compact( 'products' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Contracts\View\View The view for creating a new product.
	 */
	public function create() {
		$units      = ( new UnitService() )->list();
		$categories = ( new CategoryService() )->list();
		$suppliers  = ( new SupplierService() )->list();
		return view( 'admin.modules.product.create', compact( 'units', 'categories', 'suppliers' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param ProductStoreRequest $request The request containing validated product data.
	 * @return \Illuminate\Http\RedirectResponse Redirect to the product list view.
	 */
	public function store( ProductStoreRequest $request ) {
		$this->productService->store( $request->validated() );

		toastr( 'Product added successfully.', 'success' );

		return redirect()->route( 'product.list' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param string $id The ID of the product to display.
	 * @return void
	 */
	public function show( string $id ) {
		// Method not implemented
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param string $id The ID of the product to edit.
	 * @return \Illuminate\Contracts\View\View The view for editing a product.
	 */
	public function edit( string $id ) {
		$units      = ( new UnitService() )->list();
		$categories = ( new CategoryService() )->list();
		$suppliers  = ( new SupplierService() )->list();
		$product    = $this->productService->findProduct( $id );
		return view( 'admin.modules.product.edit', compact( 'product', 'units', 'categories', 'suppliers' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param ProductStoreRequest $request The request containing validated product data.
	 * @param string              $id The ID of the product to update.
	 * @return \Illuminate\Http\RedirectResponse Redirect to the product list view.
	 */
	public function update( ProductStoreRequest $request, string $id ) {
		$this->productService->update( $request->validated(), $id );

		toastr( 'Product updated successfully.', 'success' );

		return redirect()->route( 'product.list' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param string $id The ID of the product to delete.
	 * @return \Illuminate\Http\RedirectResponse Redirect to the product list view.
	 */
	public function destroy( string $id ) {
		$this->productService->deleteProduct( $id );

		toastr( 'Product deleted successfully.', 'success' );

		return redirect()->route( 'product.list' );
	}
}
