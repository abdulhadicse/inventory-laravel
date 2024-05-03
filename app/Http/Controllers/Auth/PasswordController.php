<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller {

	/**
	 * Update the user's password.
	 */
	public function update( Request $request ): RedirectResponse {
		$validated = $request->validateWithBag(
			'updatePassword',
			array(
				'current_password' => array( 'required', 'current_password' ),
				'password'         => array( 'required', Password::defaults(), 'confirmed' ),
			)
		);

		$request->user()->update(
			array(
				'password' => Hash::make( $validated['password'] ),
			)
		);

		toastr( 'Password has been successfully updated.', 'success' );

		return back()->with( 'status', 'password-updated' );
	}
}
