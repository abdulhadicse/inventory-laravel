<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest {
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
			'name'      => 'required|string|max:255',
			'email'     => 'required|email|unique:users',
			'mobile_no' => 'required|digits:11',
			'address'   => 'required|string|max:255',
		);
	}

	/**
	 * Modified error messages.
	 *
	 * @return array
	 */
	public function messages(): array {
		return array(
			'name.required'      => 'The name field is required.',
			'name.string'        => 'The name field must be a string.',
			'name.max'           => 'The name field must not exceed 255 characters.',
			'email.required'     => 'The email field is required.',
			'email.string'       => 'The email field must be a string.',
			'email.unique'       => 'The email address is already in use.',
			'mobile_no.required' => 'The mobile number field is required.',
			'mobile_no.digits'   => 'The mobile number field must not exceed 11 digit.',
			'address.string'     => 'The address field must be a string.',
			'address.max'        => 'The address field must not exceed 255 characters.',
		);
	}
}
