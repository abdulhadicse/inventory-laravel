<?php

namespace App\Services\Purchase;

use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
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
	public function store( array $purchaseData ): bool {
		$purchases = array();

		foreach ( $purchaseData['category_id'] as $index => $categoryId ) {
			$purchase = array(
				'date'         => date( 'Y-m-d', strtotime( $purchaseData['date'][ $index ] ) ),
				'purchase_no'  => $purchaseData['purchase_no'][ $index ],
				'supplier_id'  => $purchaseData['supplier_id'][ $index ],
				'category_id'  => $categoryId,
				'product_id'   => $purchaseData['product_id'][ $index ],
				'buying_qty'   => $purchaseData['buying_qty'][ $index ],
				'unit_price'   => $purchaseData['unit_price'][ $index ],
				'buying_price' => $purchaseData['buying_price'][ $index ],
				'created_by'   => Auth::user()->id,
				'status'       => '0',
				'created_at'   => Carbon::now(),
				'updated_at'   => Carbon::now(),
			);

			$purchases[] = $purchase;
		}

		$result = Purchase::insert( $purchases );

		return $result;
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

	public function getCategories( string $supplier_id ) {
		if ( ! $supplier_id ) {
			toastr( 'Invalid supplier', 'error' );
		}

		$categories = Product::with( array( 'category' ) )->select( 'category_id' )->where( 'supplier_id', $supplier_id )->groupBy( 'category_id' )->get();

		return response()->json( $categories );
	}


	public function getProducts( string $category_id ) {
		if ( ! $category_id ) {
			toastr( 'Invalid Category', 'error' );
		}

		$products = Product::where( 'category_id', $category_id )->get();

		return response()->json( $products );
	}
}
