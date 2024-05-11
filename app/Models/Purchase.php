<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    /**
	 * No fields are guarded.
	 *
	 * @var array
	 */
	protected $guarded = array();
}
