<?php

namespace App\Http\Controllers\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Services\Purchase\PurchaseService;
use App\Http\Requests\Purchase\PurchaseStoreRequest;
use App\Services\Supplier\SupplierService;

class PurchaseController extends Controller {

	private PurchaseService $purchaseService;

	/**
	 * Constructor for ProductController.
	 *
	 * @param ProductService $productService The ProductService instance.
	 */
	public function __construct( PurchaseService $purchaseService ) {
		$this->purchaseService = $purchaseService;
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		return view( 'admin.modules.purchase.index' );
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		$suppliers = ( new SupplierService() )->list();
		return view( 'admin.modules.purchase.create', compact( 'suppliers' ) );
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store( PurchaseStoreRequest $request ) {
		$this->purchaseService->store( $request->validated() );

		toastr( 'Purchase added successfully.', 'success' );

		return redirect()->route( 'purchase.list' );
	}

	/**
	 * Display the specified resource.
	 */
	public function show( string $id ) {
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit( string $id ) {
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update( Request $request, string $id ) {
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy( string $id ) {
	}

	/**
	 * Get category the specified resource from storage.
	 */
	public function category( Request $request ) {
		return $this->purchaseService->getCategories( $request->supplier_id );
	}

	/**
	 * Get product the specified resource from storage.
	 */
	public function product( Request $request ) {
		return $this->purchaseService->getProducts( $request->category_id );
	}
}
