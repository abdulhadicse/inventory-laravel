<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends Model {

	use HasFactory;

	/**
	 * No fields are guarded.
	 *
	 * @var array
	 */
	protected $guarded = array();

	public function invoice() {
		return $this->belongsTo( Invoice::class, 'id', 'invoice_id' );
	}
}
