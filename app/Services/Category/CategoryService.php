<?php

namespace App\Services\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class CategoryService {

	/**
	 * List all suppliers.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function list() {
		return Category::latest()->get();
	}

	/**
	 * Store a new supplier.
	 *
	 * @param array $supplierData The data for the new supplier.
	 * @return Supplier The created supplier instance.
	 * @throws ValidationException
	 */
	public function store( array $unitData ): Category {
		// Validate supplier data
		$unitData = $this->validateUnitData( $unitData );

		// Add created by user.
		$unitData['created_by'] = Auth::id();

		// Create supplier.
		$unit = Category::create( $unitData );

		return $unit;
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
	public function update( array $unitData, string $id ): Category {
        // Validate supplier data
		$unitData = $this->validateUnitData( $unitData );

		// Find supplier by ID.
		$unit = Category::findOrFail( $id );

		// Update supplier data.
		$unit->fill( $unitData );
		$unit->updated_by = Auth::id();
		$unit->save();

		return $unit;
	}

	/**
	 * Find a supplier by its ID.
	 *
	 * @param string $id The ID of the supplier to find.
	 * @return \App\Models\Supplier The supplier model instance.
	 * @throws ModelNotFoundException If no supplier is found with the given ID.
	 */
	public function findCategory( string $id ) {
		return Category::findOrFail( $id );
	}

	/**
	 * Delete a supplier by its ID.
	 *
	 * @param string $id The ID of the supplier to delete.
	 * @return bool True if the supplier is successfully deleted.
	 * @throws ModelNotFoundException If no supplier is found with the given ID.
	 */
	public function deleteCategory( string $id ) {
		$unit = Category::findOrFail( $id );
		$unit->delete();

		return true;
	}

	/**
	 * Validate supplier data.
	 *
	 * @param array $data The data to validate.
	 * @return array Validated supplier data.
	 * @throws ValidationException If validation fails.
	 */
	private function validateUnitData( array $data ): array {
		return validator(
			$data,
			array(
				'name' => 'required|string|max:255',
			)
		)->validate();
	}
}
