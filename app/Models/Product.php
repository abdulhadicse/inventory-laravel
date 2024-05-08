<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model {

	use HasFactory;

	/**
	 * No fields are guarded.
	 *
	 * @var array
	 */
	protected $guarded = array();

	/**
	 * Get the user that owns the Product
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function supplier(): BelongsTo {
		return $this->belongsTo( Supplier::class, 'supplier_id', 'id' );
	}

	/**
	 * Get the user that owns the Product.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function unit(): BelongsTo {
		return $this->belongsTo( Unit::class, 'unit_id', 'id' );
	}

	/**
	 * Get the user that owns the Product.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category(): BelongsTo {
		return $this->belongsTo( Category::class, 'category_id', 'id' );
	}
}
