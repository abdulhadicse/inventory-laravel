<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use App\Services\Customer\CustomerService;
use App\Services\Invoice\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller {
	/**
	 * The PurchaseService instance.
	 */
	private InvoiceService $invoiceService;

	/**
	 * Constructor for PurchaseController.
	 *
	 * @param PurchaseService $purchaseService The PurchaseService instance.
	 */
	public function __construct( InvoiceService $invoiceService ) {
		$this->invoiceService = $invoiceService;
	}

	/**
	 * Display a listing of purchases.
	 *
	 * @return \Illuminate\Contracts\View\View View containing a list of purchases.
	 */
	public function index() {
		$invoices = $this->invoiceService->list();
		return view( 'admin.modules.invoice.index', compact( 'invoices' ) );
	}

	/**
	 * Show the form for creating a new purchase.
	 *
	 * @return \Illuminate\Contracts\View\View View containing the purchase creation form.
	 */
	public function create() {
		$categories = ( new CategoryService() )->list();
		$customers  = ( new CustomerService() )->list();
		return view( 'admin.modules.invoice.create', compact( 'categories', 'customers' ) );
	}

	/**
	 * Store a newly created purchase in storage.
	 *
	 * @return \Illuminate\Http\RedirectResponse Redirect to the purchase list page.
	 */
	public function store( Request $request ) {
		$this->invoiceService->store( $request );

		toastr( 'Invoice added successfully.', 'success' );

		return redirect()->route( 'invoice.list' );
	}

	/**
	 * Display a listing of pending purchases.
	 *
	 * @return \Illuminate\Contracts\View\View View containing the purchase creation form.
	 */
	public function pending() {
		return 'Hello, Invoice Pending';
	}
}
