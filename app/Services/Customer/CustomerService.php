<?php

namespace App\Services\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class CustomerService {

	use FileUploadTrait;

	/**
	 * List all customers.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function list() {
		return Customer::latest()->get();
	}

	/**
	 * Store a new customer.
	 *
	 * @param  Request $request The HTTP request.
	 * @return Customer The created customer instance.
	 * @throws ValidationException
	 */
	public function store( Request $request ): Customer {
		$validatedData = $request->validated();

		// Upload avatar file if exists.
		$imageUrl = $this->uploadFile( $request, 'image', 'avatar' );
		if ( $imageUrl ) {
			$validatedData['image'] = $imageUrl;
		}

		// Add created by user.
		$validatedData['created_by'] = Auth::id();

		// Create customer.
		$customer = Customer::create( $validatedData );

		return $customer;
	}

	/**
	 * Update an existing customer.
	 *
	 * @param  Request $request The HTTP request.
	 * @param  string  $id The ID of the customer to update.
	 * @return Customer The updated customer instance.
	 * @throws ModelNotFoundException
	 * @throws ValidationException
	 */
	public function update( Request $request, string $id ): Customer {
		$customer      = Customer::findOrFail( $id );
		$validatedData = $request->validated();

		// Upload avatar file if exists.
		$imageUrl = $this->uploadFile( $request, 'image', 'avatar' );
		if ( $imageUrl ) {
			$validatedData['image'] = $imageUrl;
		}

		// Update customer data.
		$customer->fill( $validatedData );
		$customer->updated_by = Auth::id();
		$customer->save();

		return $customer;
	}

	/**
	 * Find a customer by its ID.
	 *
	 * @param  string $id The ID of the customer to find.
	 * @return \App\Models\Customer The customer model instance.
	 * @throws ModelNotFoundException If no customer is found with the given ID.
	 */
	public function findCustomer( string $id ) {
		return Customer::findOrFail( $id );
	}

	/**
	 * Delete a customer by its ID.
	 *
	 * @param  string $id The ID of the customer to delete.
	 * @return bool True if the customer is successfully deleted.
	 * @throws ModelNotFoundException If no customer is found with the given ID.
	 */
	public function deleteCustomer( string $id ) {
		$customer = Customer::findOrFail( $id );
		$customer->delete();

		return true;
	}
}
