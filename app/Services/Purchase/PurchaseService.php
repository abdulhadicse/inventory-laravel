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
	 * List all purchases.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function list() {
		return Purchase::with( array( 'supplier:id,name', 'product:id,name', 'category:id,name' ) )->latest()->get();
	}

	/**
	 * Store new purchases.
	 *
	 * @param array $purchaseData The data for the new purchases.
	 * @return bool True if the purchases are successfully stored, false otherwise.
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
	 * Update an existing purchase.
	 *
	 * @param string $id The ID of the purchase to update.
	 * @param array  $purchaseData The updated data for the purchase.
	 * @return Purchase The updated purchase instance.
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
	 * Retrieve categories for a given supplier.
	 *
	 * @param string $supplier_id The ID of the supplier.
	 * @return \Illuminate\Http\JsonResponse JSON response containing categories.
	 */
	public function getCategories( string $supplier_id ) {
		if ( ! $supplier_id ) {
			toastr( 'Invalid supplier', 'error' );
		}

		$categories = Product::with( array( 'category' ) )->select( 'category_id' )->where( 'supplier_id', $supplier_id )->groupBy( 'category_id' )->get();

		return response()->json( $categories );
	}


	/**
	 * Retrieve products for a given category.
	 *
	 * @param string $category_id The ID of the category.
	 * @return \Illuminate\Http\JsonResponse JSON response containing products.
	 */
	public function getProducts( string $category_id ) {
		if ( ! $category_id ) {
			toastr( 'Invalid Category', 'error' );
		}

		$products = Product::where( 'category_id', $category_id )->get();

		return response()->json( $products );
	}

	/**
	 * Delete a purchase by its ID.
	 *
	 * @param string $id The ID of the purchase to delete.
	 * @return bool True if the purchase is successfully deleted, false otherwise.
	 * @throws ModelNotFoundException If no purchase is found with the given ID.
	 */
	public function deletePurchase( string $id ) {
		$purchase = Product::findOrFail( $id );

		if ( ! $purchase->status ) {
			$purchase->delete();

			return true;
		}

		return false;
	}
}
