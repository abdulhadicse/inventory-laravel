<?php

namespace App\Services\Invoice;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InvoiceService {

	/**
	 * List all purchases.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function list() {
		return Invoice::latest()->get();
	}

	/**
	 * Store new purchases.
	 *
	 * @param array $purchaseData The data for the new purchases.
	 * @return bool True if the purchases are successfully stored, false otherwise.
	 * @throws ValidationException
	 */
	public function store( Request $request ): bool {
		$invoice              = new Invoice();
		$invoice->invoice_no  = $request->invoice_no;
		$invoice->date        = date( 'Y-m-d', strtotime( $request->date ) );
		$invoice->description = $request->description;
		$invoice->status      = '0';
		$invoice->created_by  = Auth::user()->id;

		DB::transaction(
			function () use ( $request, $invoice ) {
				if ( $invoice->save() ) {
					$count_category = count( $request->category_id );
					for ( $i = 0; $i < $count_category; $i++ ) {

						$invoice_details                = new InvoiceDetail();
						$invoice_details->date          = date( 'Y-m-d', strtotime( $request->date ) );
						$invoice_details->invoice_id    = $invoice->id;
						$invoice_details->category_id   = $request->category_id[ $i ];
						$invoice_details->product_id    = $request->product_id[ $i ];
						$invoice_details->selling_qty   = $request->selling_qty[ $i ];
						$invoice_details->unit_price    = $request->unit_price[ $i ];
						$invoice_details->selling_price = $request->selling_price[ $i ];
						$invoice_details->status        = '0';
						$invoice_details->save();
					}

					if ( $request->customer_id == '0' ) {
						$customer            = new Customer();
						$customer->name      = $request->name;
						$customer->mobile_no = $request->mobile_no;
						$customer->email     = $request->email;
						$customer->save();
						$customer_id = $customer->id;
					} else {
						$customer_id = $request->customer_id;
					}

					$payment         = new Payment();
					$payment_details = new PaymentDetail();

					$payment->invoice_id      = $invoice->id;
					$payment->customer_id     = $customer_id;
					$payment->paid_status     = $request->paid_status;
					$payment->discount_amount = $request->discount_amount;
					$payment->total_amount    = $request->estimated_amount;
					$payment->created_by      = Auth::user()->id;

					if ( $request->paid_status == 'full_paid' ) {
						$payment->paid_amount                 = $request->estimated_amount;
						$payment->due_amount                  = '0';
						$payment_details->current_paid_amount = $request->estimated_amount;
					} elseif ( $request->paid_status == 'full_due' ) {
						$payment->paid_amount                 = '0';
						$payment->due_amount                  = $request->estimated_amount;
						$payment_details->current_paid_amount = '0';
					} elseif ( $request->paid_status == 'partial_paid' ) {
						$payment->paid_amount                 = $request->paid_amount;
						$payment->due_amount                  = $request->estimated_amount - $request->paid_amount;
						$payment_details->current_paid_amount = $request->paid_amount;
					}
					$payment->save();

					$payment_details->invoice_id = $invoice->id;
					$payment_details->date       = date( 'Y-m-d', strtotime( $request->date ) );
					$payment_details->save();
				}
			}
		);

		return true;
	}

	/**
	 * Update an existing purchase.
	 *
	 * @param string $id The ID of the purchase to update.
	 * @return Purchase The updated purchase instance.
	 */
	public function update( string $id ): Purchase {
		// Find purchase by ID.
		$purchase = Purchase::findOrFail( $id );

		// Update product Quantity.
		$product           = Product::where( 'id', $purchase->product_id )->first();
		$product->quantity = (float) $purchase->buying_qty + (float) $product->quantity;
		$product->save();

		// Update purchase data.
		$purchase->status     = '1';
		$purchase->updated_by = Auth::id();
		$purchase->save();

		return $purchase;
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

	/**
	 * List all purchases.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function pendingList() {
		return Purchase::with( array( 'supplier:id,name', 'product:id,name', 'category:id,name' ) )->where( 'status', '0' )->latest()->get();
	}
}
