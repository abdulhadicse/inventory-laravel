<?php

namespace App\Http\Controllers\Pos;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Customer\CustomerService;
use App\Http\Requests\Customer\CustomerStoreRequest;

class CustomerController extends Controller {

	/**
	 * The customer service instance.
	 *
	 * @var CustomerService
	 */
	private CustomerService $customerService;

	/**
	 * Create a new controller instance.
	 *
	 * @param  CustomerService $customerService
	 * @return void
	 */
	public function __construct( CustomerService $customerService ) {
		$this->customerService = $customerService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return View
	 */
	public function index(): View {
		$customers = $this->customerService->list();
		return view( 'admin.modules.customers.index', compact( 'customers' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return View
	 */
	public function create(): View {
		return view( 'admin.modules.customers.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  CustomerStoreRequest $request The HTTP request.
	 * @return RedirectResponse
	 */
	public function store( CustomerStoreRequest $request ): RedirectResponse {
		$this->customerService->store( $request );

		toastr( 'Customer added successfully.', 'success' );

		return redirect()->route( 'customer.list' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string $id The ID of the unit.
	 * @return void
	 */
	public function show( string $id ) {
		// Implement if needed
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string $id The ID of the unit.
	 * @return View
	 */
	public function edit( string $id ): View {
		$customer = $this->customerService->findCustomer( $id );
		return view( 'admin.modules.customers.edit', compact( 'customer' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  CustomerStoreRequest $request The HTTP request.
	 * @param  string               $id The ID of the unit.
	 * @return RedirectResponse
	 */
	public function update( CustomerStoreRequest $request, string $id ): RedirectResponse {
		$this->customerService->update( $request, $id );

		toastr( 'Customer updated successfully.', 'success' );

		return redirect()->route( 'customer.list' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string $id The ID of the unit.
	 * @return RedirectResponse
	 */
	public function destroy( string $id ): RedirectResponse {
		$this->customerService->deleteCustomer( $id );

		toastr( 'Customer deleted successfully.', 'success' );

		return redirect()->route( 'customer.list' );
	}
}
