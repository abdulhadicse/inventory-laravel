<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {
		return array(
			'name'        => 'required|string|max:255',
			'supplier_id' => 'required|integer',
			'unit_id'     => 'required|integer',
			'category_id' => 'required|integer',
		);
	}

	/**
	 * Modified error messages.
	 *
	 * @return array
	 */
	public function messages(): array {
		return array(
			'name.required'        => 'The name field is required.',
			'name.string'          => 'The name field must be a string.',
			'name.max'             => 'The name field must not exceed 255 characters.',
			'supplier_id.required' => 'The supplier field is required.',
			'supplier_id.integer'  => 'The supplier field must be a valid supplier.',
			'unit_id.required'     => 'The unit field is required.',
			'unit_id.integer'      => 'The unit field must be a valid unit.',
			'category_id.required' => 'The category field is required.',
			'category_id.integer'  => 'The category field must be a valid category',
		);
	}
}
