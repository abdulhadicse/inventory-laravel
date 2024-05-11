<?php

namespace App\Http\Controllers\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Services\Purchase\PurchaseService;
use App\Http\Requests\Purchase\PurchaseStoreRequest;
use App\Services\Supplier\SupplierService;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller {
	/**
	 * The PurchaseService instance.
	 */
	private PurchaseService $purchaseService;

	/**
	 * Constructor for PurchaseController.
	 *
	 * @param PurchaseService $purchaseService The PurchaseService instance.
	 */
	public function __construct( PurchaseService $purchaseService ) {
		$this->purchaseService = $purchaseService;
	}

	/**
	 * Display a listing of purchases.
	 *
	 * @return \Illuminate\Contracts\View\View View containing a list of purchases.
	 */
	public function index() {
		$purchases = $this->purchaseService->list();
		return view( 'admin.modules.purchase.index', compact( 'purchases' ) );
	}

	/**
	 * Show the form for creating a new purchase.
	 *
	 * @return \Illuminate\Contracts\View\View View containing the purchase creation form.
	 */
	public function create() {
		$suppliers = ( new SupplierService() )->list();
		return view( 'admin.modules.purchase.create', compact( 'suppliers' ) );
	}

	/**
	 * Store a newly created purchase in storage.
	 *
	 * @param PurchaseStoreRequest $request The validated request object containing purchase data.
	 * @return \Illuminate\Http\RedirectResponse Redirect to the purchase list page.
	 */
	public function store( PurchaseStoreRequest $request ) {
		$this->purchaseService->store( $request->validated() );

		toastr( 'Purchase added successfully.', 'success' );

		return redirect()->route( 'purchase.list' );
	}

	/**
	 * Remove the specified purchase from storage.
	 *
	 * @param string $id The ID of the purchase to delete.
	 * @return \Illuminate\Http\RedirectResponse Redirect to the purchase list page.
	 */
	public function destroy( string $id ): RedirectResponse {
		$this->purchaseService->deletePurchase( $id );

		toastr( 'Purchase deleted successfully.', 'success' );

		return redirect()->route( 'purchase.list' );
	}

	/**
	 * Get categories for the specified supplier.
	 *
	 * @param \Illuminate\Http\Request $request The request object containing supplier ID.
	 * @return \Illuminate\Http\JsonResponse JSON response containing categories.
	 */
	public function category( Request $request ) {
		return $this->purchaseService->getCategories( $request->supplier_id );
	}

	/**
	 * Get products for the specified category.
	 *
	 * @param \Illuminate\Http\Request $request The request object containing category ID.
	 * @return \Illuminate\Http\JsonResponse JSON response containing products.
	 */
	public function product( Request $request ) {
		return $this->purchaseService->getProducts( $request->category_id );
	}
}
