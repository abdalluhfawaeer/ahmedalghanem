<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property string $type
 * @property int $encoding
 * @property int $number
 * @property int $purchasing_price
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Car extends Model
{
	protected $table = 'cars';

	protected $casts = [
		'encoding' => 'int',
		'number' => 'int',
		'purchasing_price' => 'float',
		'status' => 'int',
		'delete' => 'int',
	];

	protected $fillable = [
		'name',
		'model',
		'type',
		'encoding',
		'number',
		'purchasing_price',
		'status',
		'delete'
	];
}
