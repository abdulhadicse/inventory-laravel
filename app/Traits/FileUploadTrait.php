<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait {

	/**
	 * Upload File.
	 *
	 * @param Request $request Get all POST request data.
	 * @param string  $inputName Input field name.
	 * @param string  $path File upload folder.
	 *
	 * @return mixed
	 */
	public function uploadFile( Request $request, $inputName, $path = '/uploads' ): mixed {
		if ( $request->hasFile( $inputName ) ) {
			$image = $request->{$inputName};

			// Get image extension.
			$ext = $image->getClientOriginalExtension();

			// Create a dynamic image name.
			$imageName = 'media_' . uniqid() . '.' . $ext;

			// Upload file to a folder.
			$image->move( public_path( $path ), $imageName );

			// Image access path.
			return $path . '/' . $imageName;
		}

		return null;
	}
}
