<?php

namespace App\Rules\Purchase;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValueRequestRule implements ValidationRule {

	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
	 */
	public function validate( string $attribute, mixed $value, Closure $fail ): void {
		// Check if any of the fields have empty values
		foreach ( $value as $key => $data ) {
			if ( $data === null ) {
				$fail( 'The :attribute must not contain any empty values.' );
			}
		}
	}
}
