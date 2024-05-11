<?php

namespace App\Http\Requests\Purchase;

use App\Rules\Purchase\ValueRequestRule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseStoreRequest extends FormRequest {

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
			'product_id'   => array( 'required' ),
			'supplier_id'  => array( 'required' ),
			'category_id'  => array( 'required' ),
			'purchase_no'  => array( 'required' ),
			'date'         => array( 'required' ),
			'buying_qty'   => array( 'required', new ValueRequestRule() ),
			'unit_price'   => array( 'required', new ValueRequestRule() ),
			'buying_price' => array( 'required', new ValueRequestRule() ),
		);
	}
}
