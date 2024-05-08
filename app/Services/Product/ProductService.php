<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ProductService {

	/**
	 * List all products.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function list() {
		return Product::latest()->get();
	}

	/**
	 * Store a new product.
	 *
	 * @param array $productData The data for the new product.
	 * @return Product The created product instance.
	 * @throws ValidationException
	 */
	public function store( array $productData ): Product {
		// Add created by user.
		$productData['created_by'] = Auth::id();

		// Create product.
		$product = Product::create( $productData );

		return $product;
	}

	/**
	 * Update an existing product.
	 *
	 * @param array  $productData The updated data for the product.
	 * @param string $id The ID of the product to update.
	 * @return Product The updated product instance.
	 * @throws ModelNotFoundException
	 * @throws ValidationException
	 */
	public function update( array $productData, string $id ): Product {
		// Find product by ID.
		$product = Product::findOrFail( $id );

		// Update product data.
		$product->fill( $productData );
		$product->updated_by = Auth::id();
		$product->save();

		return $product;
	}

	/**
	 * Find a product by its ID.
	 *
	 * @param string $id The ID of the product to find.
	 * @return \App\Models\Product The product model instance.
	 * @throws ModelNotFoundException If no product is found with the given ID.
	 */
	public function findProduct( string $id ) {
		return Product::findOrFail( $id );
	}

	/**
	 * Delete a product by its ID.
	 *
	 * @param string $id The ID of the product to delete.
	 * @return bool True if the product is successfully deleted.
	 * @throws ModelNotFoundException If no product is found with the given ID.
	 */
	public function deleteProduct( string $id ) {
		$product = Product::findOrFail( $id );
		$product->delete();

		return true;
	}
}
