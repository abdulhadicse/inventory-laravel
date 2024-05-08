<?php

namespace App\Services\Purchase;

use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class PurchaseService {

	/**
	 * List all suppliers.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function list() {
		return Purchase::latest()->get();
	}

	/**
	 * Store a new supplier.
	 *
	 * @param array $supplierData The data for the new supplier.
	 * @return Supplier The created supplier instance.
	 * @throws ValidationException
	 */
	public function store( array $supplierData ): Purchase {
		// Add created by user.
		$supplierData['created_by'] = Auth::id();

		// Create supplier.
		$supplier = Purchase::create( $supplierData );

		return $supplier;
	}

	/**
	 * Update an existing supplier.
	 *
	 * @param string $id The ID of the supplier to update.
	 * @param array  $supplierData The updated data for the supplier.
	 * @return Supplier The updated supplier instance.
	 * @throws ModelNotFoundException
	 * @throws ValidationException
	 */
	public function update( array $supplierData, string $id ): Purchase {
		// Find supplier by ID.
		$supplier = Purchase::findOrFail( $id );

		// Update supplier data.
		$supplier->fill( $supplierData );
		$supplier->updated_by = Auth::id();
		$supplier->save();

		return $supplier;
	}

	/**
	 * Find a supplier by its ID.
	 *
	 * @param string $id The ID of the supplier to find.
	 * @return \App\Models\Supplier The supplier model instance.
	 * @throws ModelNotFoundException If no supplier is found with the given ID.
	 */
	public function findSupplier( string $id ) {
		return Purchase::findOrFail( $id );
	}

	/**
	 * Delete a supplier by its ID.
	 *
	 * @param string $id The ID of the supplier to delete.
	 * @return bool True if the supplier is successfully deleted.
	 * @throws ModelNotFoundException If no supplier is found with the given ID.
	 */
	public function deleteSupplier( string $id ) {
		$supplier = Purchase::findOrFail( $id );
		$supplier->delete();

		return true;
	}
}
