<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pawned
 * 
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property int $delete
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Pawned extends Model
{
	protected $table = 'pawned';

	protected $casts = [
		'delete' => 'int'
	];

	protected $fillable = [
		'name',
		'phone',
		'delete'
	];
}
